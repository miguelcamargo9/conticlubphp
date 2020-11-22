<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
//MODELOS
use App\Invoice;
use App\InvoiceReferences;
use App\Points;
use App\PointsMovements;
use App\PointsMovimentsDetail;
use App\RinPointsByProfile;
use App\User;
use App\ChangePoints;

class InvoiceController extends BaseController
{

  public function create(Request $r)
  {
    $data = json_decode(Input::post("data"), true);
    $rines = json_decode(Input::post("rines"), true);
    $infoUser = $r->user();
    $idUser = $infoUser->id;
    $idSubsidiary = $infoUser->subsidiary_id;
    $image = $r->file('image');
    $invoice = new Invoice();
    $invoice->subsidiary_id = $idSubsidiary;
    $save = true;

    $invoice->users_id = $idUser;
    foreach ($data as $column => $value) {
      $invoice->$column = $value;
    }
    try {
      if ($invoice->save()) {
        $idInvoice = $invoice->id;
        if ($r->hasfile('image')) {

          $path = public_path() . "/invoices/{$idInvoice}";

          $nomeMainOmg = $image->getClientOriginalName();
          $image->move($path, "$nomeMainOmg");
          //actualizar y guardar la imagen del registro
          $rountMailImg = "/invoices/{$idInvoice}/{$nomeMainOmg}";
          $invoice->image = $rountMailImg;
        }
        //SI GUARDA BIEN LA IMAGNE DE LA FACTURA
        if ($invoice->update()) {
          //BUSCAR EL USUARIO
          $user = User::find($idUser);
          $userProfile = $user->profiles_id;

          //GUARDAR LAS REFERENCIAS DE LA FACTURA
          $totalPoints = 0;
          foreach ($rines as $rinInfo) {

            $pointsByPerfil = RinPointsByProfile::where([["rin_id", "=", $rinInfo['rin_id']], ["profiles_id", "=", $userProfile]])->get();

            if ((count($pointsByPerfil) >= 1)) {
              $points = $rinInfo['amount'] * $pointsByPerfil[0]['total_points'];
              $totalPoints += $points;
              $invoiceReference = new InvoiceReferences();
              $invoiceReference->amount = $rinInfo['amount'];
              $invoiceReference->invoice_id = $idInvoice;
              $invoiceReference->rin_id = $rinInfo['rin_id'];
              $invoiceReference->points = $points;
              if (!$invoiceReference->save()) {
                $save = false;
              }
            } else {
              return ["message" => "error", "detail" => "Esta referencia de llanta no se encuentra activa en ContiClub"];
            }
          }
          if ($save) {
            $userActualyPoints = $user->points;
            $user->points = $userActualyPoints + $totalPoints;
            if ($user->update()) {
              $newPoints = new Points();
              $newPoints->points = $totalPoints;
              $newPoints->sum_date = date("Y-m-d");
              $newPoints->state = "complete";
              $newPoints->invoice_id = $idInvoice;
              if ($newPoints->save()) {
                $pointsMovements = new PointsMovements();
                $pointsMovements->points = $totalPoints;
                $pointsMovements->type_movement = "sum";
                $pointsMovements->date_movement = date("Y-m-d");
                if ($pointsMovements->save()) {
                  $pointsMovimentsDetail = new PointsMovimentsDetail();
                  $pointsMovimentsDetail->points = $totalPoints;
                  $pointsMovimentsDetail->points_id = $newPoints->id;
                  $pointsMovimentsDetail->points_movements_id = $pointsMovements->id;
                  $pointsMovimentsDetail->save();
                }
              }
            }
          }
          //SI GUARDA LA REFERENCIA DE FACTURA GUARDO GUARDO LOS PUNTOS
        }
      } else {
        $save = false;
      }
    } catch (\Illuminate\Database\QueryException $e) {
      $error = $e->errorInfo;
      return ($error[0] == "23000") ? ["message" => "error", "detail" => "Ya esta registrada una factura con ese numero"] : ["message" => "error", "detail" => $error[2]];
    }
    return ($save) ? ["message" => "success", "currentPoints" => $user->points, "points" => $totalPoints] : ["message" => "error"];
  }

  public function all()
  {
    $facturas = Invoice::with("user:id,name")->with("invoiceReferences.rin.design.brand")->with("points")->get();
    return $facturas;
  }

  //Get an existing invoice
  public function get($id)
  {
    $invoice = Invoice::with("user:id,name")->with("invoiceReferences.rin.design.brand")->with("points")->find($id);
    return $invoice;
  }

  //ACTUALIZAR EL HISTORIAL DE LOS PUNTOS
  private function updateHistoryPoints($idPoints, $state, $totalPoints, $newPoints = null)
  {

    //ACTUALIZO EL REGISTRO DE LOS PUNTOS
    DB::beginTransaction();
    try {
      $point = Points::find($idPoints);
      if ($newPoints != null) {
        $point->points = $newPoints;
      }
      $point->state = $state;
      $point->update();

      //GUARDO EL NUEVO MOVIMIENTO QUE SE HIZO DE LOS PUNTOS
      $pointsMovements = new PointsMovements();
      $pointsMovements->points = $totalPoints;
      $pointsMovements->type_movement = "rechazado";
      $pointsMovements->date_movement = date("Y-m-d");
      if ($pointsMovements->save()) {
        $pointsMovimentsDetail = new PointsMovimentsDetail();
        $pointsMovimentsDetail->points = $totalPoints;
        $pointsMovimentsDetail->points_id = $idPoints;
        $pointsMovimentsDetail->points_movements_id = $pointsMovements->id;
        $pointsMovimentsDetail->save();
      }
      //DB::commit();
      return true;
    } catch (Exception $e) {
      //DB::rollback();
      return false;
    }
  }

  //ENDPOINT FOR REJECTD INVOICE
  public function rejected($id, Request $r)
  {

    $info = json_decode($r->getContent(), true);
    $comment = $info["comment_rejected"];
    $invoice = Invoice::with("invoiceReferences")->with("points")->find($id)->toArray();
    $invoiceUpdate = Invoice::find($id);
    $invoiceReference = ($invoice['invoice_references']);
    $idPoints = ($invoice['points'][0]['id']);
    $totalPointsInvoice = 0;
    $saveOK = true;
    //total de puntos de la factura
    foreach ($invoiceReference as $ir) {
      $totalPointsInvoice += $ir['points'];
    }

    //usuario
    $user = User::find($invoice['users_id']);

    //TODAS LAS PETICIONES PENDIENTES DEL USUARIO PARA SABER CUATOS PUNTOS TIENE EN TOTAL
    $chageByUser = ChangePoints::where([["users_id", $user->id], ["state", "espera"]])->orderBy("points")->get()->toArray();

    $pointsApplayUSer = 0;
    foreach ($chageByUser as $ch) {
      $pointsApplayUSer += $ch['points'];
    }

    $totalPointsUser = $user->points + $pointsApplayUSer;

    if (!$this->updateHistoryPoints($idPoints, "rechazado", $totalPointsInvoice)) {
      $saveOK = false;
    } else {
      //actualizar la factura
      $invoiceUpdate->state = "Rechazada";
      $invoiceUpdate->comment_rejected = $comment;
      //actualizo los puntos del usuario
      $newPointsUSer = $totalPointsUser - $totalPointsInvoice;

      //SI NO ALCANZAN LOS NUEVOS PUNTOS DEL USUARIO, RECHAZO AUTOMATICAMENTE LA SOLICITUD DE PRODUCTO
      foreach ($chageByUser as $ch) {
        if (($newPointsUSer - $ch['points']) >= 0) {
          $newPointsUSer -= $ch['points'];
        } else {
          $nChange = ChangePoints::find($ch['id']);
          $nChange->state = "rechazado";
          $nChange->comment = "Rechazada por puntos insuficientes, verifique sus facturas";
          $nChange->update();
        }
      }
      $user->points = $newPointsUSer;
      ($invoiceUpdate->update() && $user->update()) ? DB::commit() : $saveOK = false;
    }

    return ($saveOK) ? ["message" => "success"] : ["message" => "error"];
  }
}
