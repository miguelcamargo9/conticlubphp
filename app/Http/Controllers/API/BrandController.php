<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\API;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

//MODELOS
use App\Brand;

class BrandController {
  
  
   public function all() {
    $brand = Brand::all();
    return $brand;
  }

  //CREAR UNA NUEVA MARCA
  public function create(Request $r) {
    $data = json_decode($r->getContent(), true);
    $brand = new Brand();
    foreach ($data as $column => $value) {
      $brand->$column = $value;
    }
    return( $brand->save()) ? ["message" => "success"] : ["message" => "error"];
  }

  ///OBTENER UNA MARCA EXISTENTE
  public function get($id) {
    $brand = Brand::find($id);
    return $brand;
  }

  //ACTIALIZAR UNA MARCA
  public function update($id, Request $r) {
    $data = json_decode($r->getContent(), true);
    $brand = Brand::find($id);
    foreach ($data as $column => $value) {
      $brand->$column = $value;
    }
    return( $brand->update()) ? ["message" => "success"] : ["message" => "error"];
  }
   //BORRAR UNA MARCA
  public function delete($id) {
    $brand = Brand::find($id);
    return( $brand->delete()) ? ["message" => "success"] : ["message" => "error"];
  }
}
