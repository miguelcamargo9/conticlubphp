<?php
namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;


//MODELOS
use App\Models\Subsidiaries ;
//use App\Cities;

class SubsidiariesController extends BaseController {

  public function all() {
    $subsidiarys = Subsidiaries::with("city")->with("profile")->get();
    return $subsidiarys;
  }

  //CREAR UNA NUEVA SUCURSAL
  public function create(Request $r) {
    $data = json_decode($r->getContent(), true);
    $subsidiary = new Subsidiaries();
    foreach ($data as $column => $value) {
      $subsidiary->$column = $value;
    }
    return( $subsidiary->save()) ? ["message" => "success"] : ["message" => "error"];
  }

  ///OBTENER UNA SUCURSAL EXISTENTE
  public function get($id) {
    $subsidiary = Subsidiaries::with("city")->with("profile")->find($id);
    return $subsidiary;
  }

  //ACTIALIZAR UNA SUCURSAL
  public function update($id, Request $r) {
    $data = json_decode($r->getContent(), true);
    $subsidiary = Subsidiaries::find($id);
    foreach ($data as $column => $value) {
      $subsidiary->$column = $value;
    }
    return( $subsidiary->update()) ? ["message" => "success"] : ["message" => "error"];
  }
   //BORRAR UNA SUCURSAL
  public function delete($id) {
    $subsidiary = Subsidiaries::find($id);
    return( $subsidiary->delete()) ? ["message" => "success"] : ["message" => "error"];
  }

}
