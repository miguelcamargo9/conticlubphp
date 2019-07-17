<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
//MODELOS
use App\Design;

class DesignController {

  public function all() {
    $desing = Design::with("brand")->all();
    return $desing;
  }

  //CREAR UNA NUEVO DISEÑO
  public function create(Request $r) {

    //$data = json_decode($r->getContent(), true);
    $data = json_decode(Input::post("data"), true);
    $desing = new Design();
    foreach ($data as $column => $value) {
      $desing->$column = $value;
    }
    try {
      if ($desing->save() && $r->hasfile('image')) {
        $idDesign = $desing->id;
        $img = $r->file('image');
       
        if (!$rountMailImg = $this->saveImg($img, $idDesign)) {
           return ["message" => "error"];
        }
        $desing->image = $rountMailImg;
        $desing->update();
      }
      return ["message" => "success"];
    } catch (Exception $e) {
      return ["message" => "$e"];
    }
  }

  ///OBTENER UN DISEÑO EXISTENTE
  public function get($id) {
    $desing = Design::with("brand")->find($id);
    return $desing;
  }

  //ACTIALIZAR UN DISEÑO
  public function update($id, Request $r) {
    //$data = json_decode($r->getContent(), true);
    $data = json_decode(Input::post("data"), true);
    $desing = Design::find($id);
    foreach ($data as $column => $value) {
      $desing->$column = $value;
    }
    if ($r->hasfile('image')) {
      $idDesign = $desing->id;
      $img = $r->file('image');
      $rountMailImg = $this->saveImg($img, $idDesign);
      if ($rountMailImg == false) {
        return false;
      }
      $desing->image = $rountMailImg;
    }
    return( $desing->update()) ? ["message" => "success"] : ["message" => "error"];
  }

  //BORRAR UN DISEÑO
  public function delete($id) {
    $desing = Design::find($id);
    return( $desing->delete()) ? ["message" => "success"] : ["message" => "error"];
  }

  //GUARDAR UNA IAMGEN
  private function saveImg($img, $idDesign) {
    $path = public_path() . "/desing/{$idDesign}";

    $nameImg = $img->getClientOriginalName();

    //actualizar y guardar la imagen del registro
    $rountMailImg = "/desing/{$idDesign}}/{$nameImg}";
   
    return $img->move($path, "$nameImg") ? $rountMailImg : false;
  }
  
  //RETORNAR UN DISEÑO POR MARCA
  public function getByBrand($idBrand) {
    $desing = Design::where("brand_id","=",$idBrand)->orderBy('name', 'ASC')->get();
    return $desing;
  }

}
