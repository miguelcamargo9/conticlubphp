<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//MODELOS
Use App\ChangePoints;
Use App\Product;
Use App\User;
Use App\Points;
use App\PointsMovements;
use App\PointsMovimentsDetail;
use App\Invoice;

class ChangePointsController extends BaseController {

  //APLICAR PARA CAMBIAR PUNTOS POR UN PRODUCTO
  public function applyFor(Request $r) {
    $infoUser = $r->user();
    $info = json_decode($r->getContent(), true);
    $infoProduct = Product::find($info['product_id']);
    if ($infoUser->points >= $infoProduct->points) {
      $newApply = new ChangePoints();
      $newApply->state = "espera";
      $newApply->product_id = $infoProduct->id;
      $newApply->users_id = $infoUser->id;
      $newApply->points = $infoProduct->points;

      //restarle los puntos del producto al usuario
      $infoUser->points = $infoUser->points - $infoProduct->points;
      return( $newApply->save() && $infoUser->update()) ? ["message" => "success", "currentPoints" => $infoUser->points, "points" => $infoProduct->points] : ["message" => "error"];
    } else {
      return["message" => "error", "detail" => "No cuenta con puntos suficientes"];
    }
  }

  //ACTUALIZAR EL HISTORIAL DE LOS PUNTOS
  private function updateHistoryPoints($idPoints, $state, $totalPoints, $newPoints, $idInvoice) {

    //ACTUALIZO EL REGISTRO DE LOS PUNTOS
    DB::beginTransaction();
    try {
      $point = Points::find($idPoints);
      $point->points = $newPoints;
      $point->state = $state;
      $point->update();

      //GUARDO EL NUEVO MOVIMIENTO QUE SE HIZO DE LOS PUNTOS
      $pointsMovements = new PointsMovements();
      $pointsMovements->points = $totalPoints;
      $pointsMovements->type_movement = "res";
      $pointsMovements->date_movement = date("Y-m-d");
      if ($pointsMovements->save()) {
        $pointsMovimentsDetail = new PointsMovimentsDetail();
        $pointsMovimentsDetail->points = $totalPoints;
        $pointsMovimentsDetail->points_id = $idPoints;
        $pointsMovimentsDetail->points_movements_id = $pointsMovements->id;
        $pointsMovimentsDetail->save();
        //ACTUALIZO LA FACTURA
        $invoice = Invoice::find($idInvoice);
        switch ($state) {
          case "partial":
            $iState = "Parcial";
            break;
          case "used":
            $iState = "Usada";
            break;
          default :
            break;
        }
        $invoice->state = $iState;
        $invoice->update();
      }
      //DB::commit();
      return true;
    } catch (Exception $e) {
      DB::rollback();
      return false;
    }
  }

  public function approve($id, Request $r) {
    $change = ChangePoints::find($id);
    $user = $r->user();
    if ($user->profiles_id == 4) {
      $info = json_decode($r->getContent(), true);
      $pointsUser = User::where("users.id", $change->users_id)->where(function($query){$query->where('points.state', '=', "complete")->orWhere('points.state', '=', "partial");})
                      ->leftJoin('invoice', 'invoice.users_id', '=', 'users.id')
                      ->leftJoin('points', [['points.invoice_id', '=', 'invoice.id']])
                      ->select('points.points as puntos', 'invoice.id as factura', 'points.id as points_id')
                      ->orderBy('points.created_at', 'asc')->get()->toArray();

      $pintsProduct = $change->points;
      $count = 0;
      $pointsComplete = false;
      $saveOK = true;

      if (!empty($pointsUser)) {
        //RECORRO LOS PUNTOS QUE TIENE EL USUARIO PARA EMPEZAR A DECONTAR
        while (!$pointsComplete) {
          $idInvoice = $pointsUser[$count]['factura'];
          $p = $pointsUser[$count]['puntos'];
          $idPoints = $pointsUser[$count]['points_id'];
          $complete = $pintsProduct - $p;
          $state = "";
          $newPoints = null;
          $pointsSave = 0;
          
          if ($complete < 0) {
            $newPoints = ($complete * (-1));
            $pointsSave = $p - $newPoints;
            $pointsComplete = true;
            $state = "partial";
          } elseif ($complete == 0) {
            $newPoints = 0;
            $pointsComplete = true;
            $pointsSave = $p;
            $state = "used";
          } else {
            $newPoints = 0;
            $pointsSave = $p;
            $pintsProduct = $complete;
            $state = "used";
          }
          
          if (!$this->updateHistoryPoints($idPoints, $state, $pointsSave, $newPoints, $idInvoice)) {
            $saveOK = false;
          } else {
            $change->comment = ($info['comment'] != null) ? $info['comment'] : null;
            $change->state = "aprobado";
            $change->approver_id = $user->id;
            ($change->update()) ? DB::commit() : $saveOK = false;
          }
          $count++;
        }
        return($saveOK) ? ["message" => "success"] : ["message" => "error"];
      } else {
        return["message" => "error", "detail" => "No se encontraron facturas del usuario"];
      }
    } else {

      return["message" => "No tiene permitodo hacer esta acción"];
    }
    //print_r($pointsUser);
  }

  //RECHAZAR EL CAMBIO DE PUNTOS POR UN PRODUCTO
  public function reject($id, Request $r) {
    $change = ChangePoints::find($id);
    $user = $r->user();

    if ($user->profiles_id == 4) {
      $info = json_decode($r->getContent(), true);

      //LE DEVUELVO LOS PUNTOS AL USUARIO
      $client = User::find($change->users_id);
      $client->points = $client->points + $change->points;
      $client->update();

      //ACTUALIZO LA SOLICITUD DE CAMBIO DE PUNTOS POR PRODUCTOS
      $change->comment = $info['comment'];
      $change->state = "rechazado";
      $change->approver_id = $user->id;
      return ($change->update()) ? ["message" => "success"] : ["message" => "error"];
    } else {
      return["message" => "No tiene permitodo hacer esta acción"];
    }
  }

  //RETORNAR TODAS LAS SOLICITUDES QUE SE HAN HECHO
  public function all() {
    $change = ChangePoints::with("product")->with(
                    [
                        "user" => function($q) {
                          $q->select(["id", "name", 'subsidiary_id', 'identification_number', 'points']);
                        },
                        "user.subsidiary" => function($p) {
                          $p->select(["id", "name", "cities_id"]);
                        },
                        "user.subsidiary.city" => function($p) {
                          $p->select(["id", "name"]);
                        }
            ])->get();
    return $change;
  }

  //RETORNAR TODAS LAS SOLICITUDES DE UN USUARIO
  public function GetbyUser($idUser) {
    $change = ChangePoints::with("product")->with([
                "user" => function($q) {
                  $q->select(["id", "name", 'subsidiary_id', 'identification_number', 'points']);
                },
                "user.subsidiary" => function($p) {
                  $p->select(["id", "name", "cities_id"]);
                },
                "user.subsidiary.city" => function($p) {
                  $p->select(["id", "name"]);
                }
            ])->where("users_id", $idUser)->get();
    return $change;
  }

  //RETORNAR TODAS LAS SOLICITUDES DE UN USUARIO
  public function get($id) {
    $change = ChangePoints::with("product")->with([
                "user" => function($q) {
                  $q->select(["id", "name", 'subsidiary_id', 'identification_number', 'points']);
                },
                "user.subsidiary" => function($p) {
                  $p->select(["id", "name", "cities_id"]);
                },
                "user.subsidiary.city" => function($p) {
                  $p->select(["id", "name"]);
                }
            ])->find($id);
    return $change;
  }

  //RECHAZAR EL CAMBIO DE PUNTOS POR UN PRODUCTO
  public function buyed($id, Request $r) {
    $change = ChangePoints::find($id);
    $user = $r->user();

    if ($user->profiles_id == 5) {
      $info = json_decode($r->getContent(), true);


      //ACTUALIZO LA SOLICITUD DE CAMBIO DE PUNTOS POR PRODUCTOS
      $change->buyer_comment = $info['buyer_comment'];
      $change->purchase_date = $info['purchase_date'];
      $change->state = "comprado";
      $change->buyer_id = $user->id;
      return ($change->update()) ? ["message" => "success"] : ["message" => "error"];
    } else {
      return["message" => "No tiene permitodo hacer esta acción"];
    }
  }

}
