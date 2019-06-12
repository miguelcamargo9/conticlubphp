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

class InvoiceController extends BaseController {

  public function create(Request $r) {
    $data = json_decode(Input::post("data"), true);
    $rines = json_decode(Input::post("rines"), true);
    $image = $r->file('image');

    $invoice = new Invoice();

    foreach ($data as $column => $value) {
      $invoice->$column = $value;
    }

    if ($invoice->save()) {
      $idInvoice = $invoice->id;
      $path = public_path() . "/invoices/{$idInvoice}";

      $nomeMainOmg = $image->getClientOriginalName();
      $image->move($path, "$nomeMainOmg");
      //actualizar y guardar la imagen del registro
      $rountMailImg = "{$path}/{$nomeMainOmg}";
      $rountMailImg = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $rountMailImg);
      $idInvoice->image = $rountMailImg;
      //SI GUARDA BIEN LA IMAGNE DE LA FACTURA
      if($idInvoice->update()){
        //GUARDAR LAS REFERENCIAS DE LA FACTURA
        $invoiceReference = new invoiceReference();
        $invoiceReference->invoice_id = $idInvoice;
        foreach ($rines as $column => $value) {
          $invoiceReference->$column=$value;
        }
        //SI GUARDA LA REFERENCIA DE FACTURA GUARDO GUARDO LOS PUNTOS
      }
    }
  }

}
