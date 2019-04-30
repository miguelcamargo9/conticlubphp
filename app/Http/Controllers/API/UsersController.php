<?php

namespace App\Http\Controllers\API;


use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

//MODELOS
use App\User;

class UsersController extends BaseController {

  use AuthorizesRequests,
      ValidatesRequests;
  
  public function allUsers(){  
    $users = User::all();
    return$users;
  }

  public function create(Request $r) {
    $userR=json_decode($r->getContent(), true);
    $myUser = new User();
    foreach ($userR as $column => $value) {
      $value = ($column=="password")?bcrypt($value):$value;
      $myUser->$column = $value;
    }
    return( $myUser->save())?"ok":"error";
  }
}

