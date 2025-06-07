<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Models
use App\Models\ChangePoints;
use App\Models\Product;
use App\User;
use App\Models\Point;
use App\Models\PointsMovement;
use App\Models\PointsMovementsDetail;
use App\Models\Invoice;

class ChangePointsController extends BaseController
{

    //Apply for change points for a product
    public function applyFor(Request $r): array
    {
        $infoUser = $r->user();
        $info = json_decode($r->getContent(), true);
        $infoProduct = Product::find($info['product_id']);
        if ($infoUser->points >= $infoProduct->points) {
            $newApply = new ChangePoints();
            $newApply->state = "espera";
            $newApply->product_id = $infoProduct->id;
            $newApply->users_id = $infoUser->id;
            $newApply->points = $infoProduct->points;

            //Reduce the points of the user
            $infoUser->points = $infoUser->points - $infoProduct->points;
            return($newApply->save() && $infoUser->update()) ?
                ["message" => "success", "currentPoints" => $infoUser->points, "points" => $infoProduct->points] :
                ["message" => "error"];
        } else {
            return["message" => "error", "detail" => "No cuenta con puntos suficientes"];
        }
    }

    //Update the history of the change points

    /**
     * @throws Exception
     */
    private function updateHistoryPoints($idPoints, $state, $totalPoints, $newPoints, $idInvoice): bool
    {

        //Update the record of the points
        DB::beginTransaction();
        try {
            $point = Point::find($idPoints);
            $point->points = $newPoints;
            $point->state = $state;
            $point->update();

            //Save the new movement of the points
            $pointsMovements = new PointsMovement();
            $pointsMovements->points = $totalPoints;
            $pointsMovements->type_movement = "res";
            $pointsMovements->date_movement = date("Y-m-d");
            if ($pointsMovements->save()) {
                $pointsMovementsDetail = new PointsMovementsDetail();
                $pointsMovementsDetail->points = $totalPoints;
                $pointsMovementsDetail->points_id = $idPoints;
                $pointsMovementsDetail->points_movements_id = $pointsMovements->id;
                $pointsMovementsDetail->save();
                //Update the invoice
                $invoice = Invoice::find($idInvoice);
                switch ($state) {
                    case "partial":
                        $iState = "Parcial";
                        break;
                    case "used":
                        $iState = "Usada";
                        break;
                    default:
                        break;
                }
                $invoice->state = $iState ?? "";
                $invoice->update();
            }
            //DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }

    /**
     * @throws Exception
     */
    public function approve($id, Request $r): array
    {
        $change = ChangePoints::find($id);
        $user = $r->user();
        if ($user->profiles_id == 4) {
            $info = json_decode($r->getContent(), true);
            $pointsUser = User::where("users.id", $change->users_id)->where(function ($query) {
                $query->where('points.state', '=', "complete")->orWhere('points.state', '=', "partial");
            })
                      ->leftJoin('invoice', 'invoice.users_id', '=', 'users.id')
                      ->leftJoin('points', 'points.invoice_id', '=', 'invoice.id')
                      ->select(['points.points as points', 'invoice.id as invoice', 'points.id as points_id'])
                      ->orderBy('points.created_at')->get()->toArray();

            $pintsProduct = $change->points;
            $count = 0;
            $pointsComplete = false;
            $saveOK = true;

            if (!empty($pointsUser)) {
                //Retrieve the points of the user to start to discount
                while (!$pointsComplete) {
                    $idInvoice = $pointsUser[$count]['invoice'];
                    $p = $pointsUser[$count]['points'];
                    $idPoints = $pointsUser[$count]['points_id'];
                    $complete = $pintsProduct - $p;

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
            return["message" => "No tiene permitido hacer esta acción"];
        }
    }


    //Rejection of the change points for a product
    public function reject($id, Request $r): array
    {
        $change = ChangePoints::find($id);
        $user = $r->user();

        if ($user->profiles_id == 4) {
            $info = json_decode($r->getContent(), true);

            //Return the points to the user
            $client = User::find($change->users_id);
            $client->points = $client->points + $change->points;
            $client->update();

            //Update the request of the change points for a product
            $change->comment = $info['comment'];
            $change->state = "rechazado";
            $change->approver_id = $user->id;
            return ($change->update()) ? ["message" => "success"] : ["message" => "error"];
        } else {
            return["message" => "No tiene permitido hacer esta acción"];
        }
    }

    //Return all the requests that have been made
    public function all()
    {
        return ChangePoints::with("product")->with(
            [
                "user" => function ($q) {
                    $q->select(["id", "name", 'subsidiary_id', 'identification_number', 'points']);
                },
                "user.subsidiary" => function ($p) {
                    $p->select(["id", "name", "cities_id"]);
                },
                "user.subsidiary.city" => function ($p) {
                    $p->select(["id", "name"]);
                }
            ]
        )->get();
    }

    //Return all the requests that have been made by a user
    public function getByUser($idUser)
    {
        return ChangePoints::with("product")->with([
            "user" => function ($q) {
                $q->select(["id", "name", 'subsidiary_id', 'identification_number', 'points']);
            },
            "user.subsidiary" => function ($p) {
                $p->select(["id", "name", "cities_id"]);
            },
            "user.subsidiary.city" => function ($p) {
                $p->select(["id", "name"]);
            }
        ])->where("users_id", $idUser)->get();
    }

    //Return a change point by id
    public function get($id)
    {
        return ChangePoints::with("product")->with([
            "user" => function ($q) {
                $q->select(["id", "name", 'subsidiary_id', 'identification_number', 'points']);
            },
            "user.subsidiary" => function ($p) {
                $p->select(["id", "name", "cities_id"]);
            },
            "user.subsidiary.city" => function ($p) {
                $p->select(["id", "name"]);
            }
        ])->find($id);
    }

    //Update the state of the change points for a product to "comprado"
    public function bought($id, Request $r): array
    {
        $change = ChangePoints::find($id);
        $user = $r->user();

        if ($user->profiles_id == 5) {
            $info = json_decode($r->getContent(), true);


            //Update the request of the change points for a product
            $change->buyer_comment = $info['buyer_comment'];
            $change->purchase_date = $info['purchase_date'];
            $change->state = "comprado";
            $change->buyer_id = $user->id;
            return ($change->update()) ? ["message" => "success"] : ["message" => "error"];
        } else {
            return["message" => "No tiene permitido realizar esta acción"];
        }
    }
}
