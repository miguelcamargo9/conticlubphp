<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

// Models
use App\Models\Invoice;
use App\Models\InvoiceReferences;
use App\Models\Points;
use App\Models\PointsMovements;
use App\Models\PointsMovementsDetail;
use App\Models\TirePointsByProfile;
use App\User;
use App\Models\ChangePoints;

class InvoiceController extends BaseController
{
    public function create(Request $req): array
    {
        $data = json_decode(Input::post("data"), true);

        if (isset($data['sale_date']) && $data['sale_date'] < '2023-05-01') {
            return ["message" => "error", "detail" => "La fecha de venta no puede ser menor a mayo de 2023."];
        }

        $tires = json_decode(Input::post("tires"), true);
        $infoUser = $req->user();
        $idUser = $infoUser->id;
        $idSubsidiary = $infoUser->subsidiary_id;
        $image = $req->file('image');
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
                if ($req->hasfile('image')) {
                    // Store the file in S3 inside the 'invoices' folder
                    $path = "/files/invoices/{$idUser}/{$idInvoice}-{$image->getClientOriginalName()}";
                    Storage::disk('s3')->put($path, file_get_contents($image));

                    $invoice->image = $path;
                }
                //If the invoice image is saved correctly
                if ($invoice->update()) {
                    $user = User::find($idUser);
                    $userProfile = $user->profiles_id;

                    //Save the invoice references
                    $totalPoints = 0;
                    foreach ($tires as $tireInfo) {
                        $pointsByProfile = TirePointsByProfile::where(
                            [["tire_id", "=", $tireInfo['tire_id']], ["profiles_id", "=", $userProfile]]
                        )->get();

                        if ((count($pointsByProfile) >= 1)) {
                            $points = $tireInfo['amount'] * $pointsByProfile[0]['total_points'];
                            $totalPoints += $points;
                            $invoiceReference = new InvoiceReferences();
                            $invoiceReference->amount = $tireInfo['amount'];
                            $invoiceReference->invoice_id = $idInvoice;
                            $invoiceReference->tire_id = $tireInfo['tire_id'];
                            $invoiceReference->points = $points;
                            if (!$invoiceReference->save()) {
                                $save = false;
                            }
                        } else {
                            return [
                                "message" => "error",
                                "detail" => "Esta referencia de llanta no se encuentra activa en ContiClub"
                            ];
                        }
                    }
                    if ($save) {
                        $currentUserPoints = $user->points;
                        $user->points = $currentUserPoints + $totalPoints;
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
                                    $pointsMovementsDetail = new PointsMovementsDetail();
                                    $pointsMovementsDetail->points = $totalPoints;
                                    $pointsMovementsDetail->points_id = $newPoints->id;
                                    $pointsMovementsDetail->points_movements_id = $pointsMovements->id;
                                    $pointsMovementsDetail->save();
                                }
                            }
                        }
                    }
                    //SI GUARDA LA REFERENCIA DE FACTURA GUARDO GUARDO LOS PUNTOS
                }
            } else {
                $save = false;
            }
        } catch (QueryException $e) {
            $error = $e->errorInfo;
            return ($error[0] == "23000") ?
                ["message" => "error", "detail" => "Ya esta registrada una factura con ese numero"] :
                ["message" => "error", "detail" => $error[2]];
        } catch (Exception $e) {
            return ["message" => "error", "detail" => $e->getMessage()];
        }
        return ($save) ?
            ["message" => "success", "currentPoints" => $user->points, "points" => $totalPoints] :
            ["message" => "error"];
    }

    public function all()
    {
        return Invoice::with("user:id,name")->with("invoiceReferences.tire.design.brand")->with("points")->get();
    }

    //Get an existing invoice
    public function get($id)
    {
        return Invoice::with("user:id,name")->with("invoiceReferences.tire.design.brand")->with("points")->find($id);
    }

    //Update the history of the points

    /**
     * @throws Exception
     */
    private function updateHistoryPoints($idPoints, $state, $totalPoints, $newPoints = null): bool
    {
        //Update the history of the points
        DB::beginTransaction();
        try {
            $point = Points::find($idPoints);
            if ($newPoints != null) {
                $point->points = $newPoints;
            }
            $point->state = $state;
            $point->update();

            //Save the new movement that was made of the points
            $pointsMovements = new PointsMovements();
            $pointsMovements->points = $totalPoints;
            $pointsMovements->type_movement = "rechazado";
            $pointsMovements->date_movement = date("Y-m-d");
            if ($pointsMovements->save()) {
                $pointsMovementsDetail = new PointsMovementsDetail();
                $pointsMovementsDetail->points = $totalPoints;
                $pointsMovementsDetail->points_id = $idPoints;
                $pointsMovementsDetail->points_movements_id = $pointsMovements->id;
                $pointsMovementsDetail->save();
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    //Reject an invoice

    /**
     * @throws Exception
     */
    public function rejected($id, Request $request): array
    {
        try {
            $invoice = Invoice::with(['invoiceReferences', 'user', 'points'])->find($id);

            if (!$invoice) {
                return ['message' => 'Factura no encontrada'];
            }

            $comment = $request->input('comment_rejected');

            $totalPointsInvoice = $invoice->invoiceReferences->sum('points');
            $user = $invoice->user;

            $idPoints = null;

            if (!empty($invoice->points)) {
                $points = $invoice->points->first();
                if (!empty($points->id)) {
                    $idPoints = $points->id;
                }
            }

            //All pending requests from the user to know how many points you have in total
            $changeByUser = ChangePoints::where(
                [["users_id", $user->id], ["state", "espera"]]
            )->orderBy("points")->get()->toArray();

            $pointsApplyUSer = 0;
            foreach ($changeByUser as $ch) {
                $pointsApplyUSer += $ch['points'];
            }

            $totalPointsUser = $user->points + $pointsApplyUSer;

            $saveOK = true;

            if ($idPoints && !$this->updateHistoryPoints($idPoints, "rechazado", $totalPointsInvoice)) {
                $saveOK = false;
            } else {
                //update the invoice
                $invoice->state = "Rechazada";
                $invoice->rejection_comment = $comment;

                //update the points of the user
                $newPointsUSer = $totalPointsUser - $totalPointsInvoice;

                //If the new user points are not enough, I reject the product request
                foreach ($changeByUser as $ch) {
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
                ($invoice->update() && $user->update()) ? DB::commit() : $saveOK = false;
            }
            return ($saveOK) ? ["message" => "success"] : ["message" => "error"];
        } catch (Exception $e) {
            return ['message' => 'Ha ocurrido un error al rechazar la factura'];
        }
    }

    //Approve an invoice
    public function approved($idInvoice, Request $r): array
    {
        $user = $r->user();
        if ($user->profiles_id == 4) {
            $invoiceUpdate = Invoice::find($idInvoice);
            $invoiceUpdate->state = "Aprobada";
            return ($invoiceUpdate->update()) ? ["message" => "success"] : ["message" => "error"];
        } else {
            return["message" => "No tiene permitodo hacer esta acción"];
        }
    }

    public function getByState($state)
    {
        return Invoice::where("state", $state)->with("invoiceReferences")->with("points")->get();
    }
}
