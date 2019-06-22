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
  
  public function all(){  
    $users = User::with("profile")->with("subsidiary")->get();
    return $users;
  }

  //CREAR UN NUEVO USUARIO
  public function create(Request $r) {
    $userR=json_decode($r->getContent(), true);
    $myUser = new User();
    foreach ($userR as $column => $value) {
      $value = ($column=="password")?bcrypt($value):$value;
      $myUser->$column = $value;
    }
    return( $myUser->save())?["message"=>"success"]:["message"=>"error"];
  }
  
  ///OBTENER UN USUARIO EXISTENTE
  public function get($id) {
    $user = User::with("profile")->with("subsidiary")->find($id);
    return $user;
  }
  
  //ACTIALIZAR UN USUARIO
  public function update($id,Request $r) {
    $userR=json_decode($r->getContent(), true);
    $user = User::find($id);
    foreach ($userR as $column => $value) {
      $value = ($column=="password")?bcrypt($value):$value;
      $user->$column = $value;
    }
    return( $user->update())?["message"=>"success"]:["message"=>"error"];
  }
  
  //USUARIOS CON SUCURSAL
  public function withSubsidiary (){
    $users = User::where("subsidiary_id","!=","NULL")->with("profile")->with("subsidiary")->get();
    return (empty($users))?["message" => "No se encontraron registros"]:$users;
  }
  
}
