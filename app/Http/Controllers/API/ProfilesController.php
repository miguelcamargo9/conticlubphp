<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Profiles;

class ProfilesController extends BaseController {

  use AuthorizesRequests,
      ValidatesRequests;

  public function allProfiles() {
    $profiles = Profiles::all();
    return $profiles;
  }

  //Get all profiles
  public function all() {
    $profiles = Profiles::all();
    return $profiles;
  }

  //Create a new profile
  public function create(Request $r) {
    $profileR = json_decode($r->getContent(), true);
    $profile = new Profiles();
    foreach ($profileR as $column => $value) {
      $profile->$column = $value;
    }
    return( $profile->save()) ? ["message" => "success"] : ["message" => "error"];
  }

  //Get an existing profile
  public function get($id) {
    $profile = Profiles::find($id);
    return $profile;
  }

  //Update a profile
  public function update($id, Request $r) {
    $profileR = json_decode($r->getContent(), true);
    $profile = Profiles::find($id);
    foreach ($profileR as $column => $value) {
      $profile->$column = $value;
    }
    return( $profile->update()) ? ["message" => "success"] : ["message" => "error"];
  }

}
