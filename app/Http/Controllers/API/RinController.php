<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
//MODELOS
use App\Rin;
use App\RinPointsByProfile;

class RinController extends BaseController {

  public function all() {
    $producs = Rin::with("design")->get();
    return $producs;
  }

  public function create(Request $r) {

    $saveOK = true;
    $data = json_decode($r->getContent(), true);
    $rin = new Rin();
    foreach ($data as $column => $value) {
      if ($column != "rin_points") {
        $rin->$column = $value;
      }
    }
    if ($rin->save()) {

      $idRin = $rin->id;

      foreach ($data['rin_points'] as $points) {
        $rinByProfile = new RinPointsByProfile();
        $rinByProfile->rin_id = $idRin;
        $rinByProfile->profiles_id = $points['profiles_id'];
        $rinByProfile->points_general = $points['points_general'];
        $rinByProfile->points_uhp = $points['points_uhp'];
        $rinByProfile->total_points = $points['points_general'] + $points['points_uhp'];
        if (!$rinByProfile->save()) {
          $saveOK = false;
        }
      }

      return($saveOK) ? ["message" => "success"] : ["message" => "error"];
    } else {
      return["message" => "error"];
    }
  }

  ///OBTENER UN RIN EXISTENTE
  public function get($id) {
    $rin = Rin::with("design")->with("rinPointsByPerfils")->find($id);
    return $rin;
  }

  //ACTIALIZAR UN RIN
  public function update($id, Request $r) {
    $data = json_decode($r->getContent(), true);
    $rin = Rin::find($id);
    $saveOK = true;
    foreach ($data as $column => $value) {
      if ($column != "rin_points") {
        $rin->$column = $value;
      }
    }
    if ($rin->update()) {
      $DrinByProfile = RinPointsByProfile::where("rin_id", "=", $rin->id)->delete();

      foreach ($data['rin_points'] as $points) {
        $rinByProfile = new RinPointsByProfile();
        $rinByProfile->rin_id = $rin->id;
        $rinByProfile->profiles_id = $points['profiles_id'];
        $rinByProfile->points_general = $points['points_general'];
        $rinByProfile->points_uhp = $points['points_uhp'];
        $rinByProfile->total_points = $points['points_general'] + $points['points_uhp'];
        if (!$rinByProfile->save()) {
          $saveOK = false;
        }
      }
      return( $saveOK) ? ["message" => "success"] : ["message" => "error"];
    } else {
      return ["message" => "error"];
    }
  }

  //BORRAR UN RIN
  public function delete($id) {
    $rin = Rin::find($id);
    return( $rin->delete()) ? ["message" => "success"] : ["message" => "error"];
  }

  //RETORNAR UN RIN  POR DISEÑO
  public function getByDesign($idDesign) {
    $desing = Rin::where("design_id", "=", $idDesign)->orderBy('name', 'ASC')->get();
    return $desing;
  }

}
