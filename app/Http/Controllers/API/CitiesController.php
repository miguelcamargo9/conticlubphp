<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Cities;

class CitiesController extends BaseController {

  use AuthorizesRequests,
      ValidatesRequests;

  public function all() {
    $cities = Cities::all();
    return $cities;
  }

  //CREAR UNA NUEVA CIUDAD
  public function create(Request $r) {
    $cityR = json_decode($r->getContent(), true);
    $city = new Cities();
    foreach ($cityR as $column => $value) {
      $city->$column = $value;
    }
    return( $city->save()) ? ["message" => "success"] : ["message" => "error"];
  }
  
  ///OBTENER UNA CIUDAD EXISTENTE
  public function get($id) {
    $city = Cities::find($id);
    return $city;
  }
  
  //ACTIALIZAR UNA CIUDAD
  public function update($id,Request $r) {
    $cityR=json_decode($r->getContent(), true);
    $city = Cities::find($id);
    foreach ($cityR as $column => $value) {
      $city->$column = $value;
    }
    return( $city->update())?["message"=>"success"]:["message"=>"error"];
  }

}
