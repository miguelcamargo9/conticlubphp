<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
//MODELOS
use App\Invoice;
use App\InvoiceReferences;
use App\Points;
use App\PointsMovements;
use App\PointsMovimentsDetail;
use App\RinPointsByProfile;
use App\User;

class InvoiceController extends BaseController {

  public function create(Request $r) {
    $data = json_decode(Input::post("data"), true);
    $rines = json_decode(Input::post("rines"), true);
    $idUser = $data["users_id"];
    $image = $r->file('image');
    $invoice = new Invoice();
    $save = true;


    foreach ($data as $column => $value) {
      $invoice->$column = $value;
    }

    if ($invoice->save()) {
      $idInvoice = $invoice->id;
      $path = public_path() . "/invoices/{$idInvoice}";

      $nomeMainOmg = $image->getClientOriginalName();
      $image->move($path, "$nomeMainOmg");
      //actualizar y guardar la imagen del registro
      $rountMailImg = "/invoices/{$idInvoice}/{$nomeMainOmg}";
      $invoice->image = $rountMailImg;
      //SI GUARDA BIEN LA IMAGNE DE LA FACTURA
      if ($invoice->update()) {
        //BUSCAR EL USUARIO
        $user = User::find($idUser);
        $userProfile = $user->profiles_id;

        //GUARDAR LAS REFERENCIAS DE LA FACTURA
        $totalPoints = 0;
        foreach ($rines as $rinInfo) {

          $pointsByPerfil = RinPointsByProfile::where([["rin_id", "=", $rinInfo['rin_id']], ["profiles_id", "=", $userProfile]])->get();

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
                $pointsMovimentsDetail->points_movements_id = $newPoints->id;
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

    return ($save) ? ["message" => "success"] : ["message" => "error"];
  }

}
