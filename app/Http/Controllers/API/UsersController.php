<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Mail\contactenos;
use Illuminate\Support\Facades\Mail;
//MODELOS
use App\User;

class UsersController extends BaseController {

  use AuthorizesRequests,
      ValidatesRequests;

  public function all() {
    $users = User::with("profile")->with("subsidiary")->get();
    return $users;
  }

  //CREAR UN NUEVO USUARIO
  public function create(Request $r) {
    //$userR=json_decode($r->getContent(), true);
    $userR = json_decode(Input::post("data"), true);
    $image = $r->file('image');
    $inDb = User::where("identification_number", $userR['identification_number'])->orWhere("email", $userR['email'])->count();
    $save = true;

    if ($inDb <= 0) {
      $myUser = new User();
      foreach ($userR as $column => $value) {
        $value = ($column == "password") ? bcrypt($value) : $value;
        $myUser->$column = $value;
      }
      if ($myUser->save()) {
        if ($r->hasfile('image')) {
          $idUser = $myUser->id;
          $path = public_path() . "/users/{$idUser}";

          $nomeMainOmg = $image->getClientOriginalName();
          $image->move($path, "$nomeMainOmg");
          //actualizar y guardar la imagen del registro
          $rountMailImg = "/users/{$idUser}/$nomeMainOmg";
          $myUser->image = urlencode($rountMailImg);
          if (!$myUser->update()) {
            $save = false;
          }
        }
      } else {
        $save = false;
      }
      return($save) ? ["message" => "success"] : ["message" => "error"];
    } else {
      return["message" => "Este usuario ya se encuentra registrado"];
    }
  }

  ///OBTENER UN USUARIO EXISTENTE
  public function get($id) {
    $user = User::with("profile")->with("subsidiary")->find($id);
    return $user;
  }

  //ACTIALIZAR UN USUARIO
  public function update($id, Request $r) {
    //$userR = json_decode($r->getContent(), true);
    $user = User::find($id);
    $userR = json_decode(Input::post("data"), true);
    $image = $r->file('image');
    $save = true;
    if ($userR != NULL) {
      foreach ($userR as $column => $value) {
        $value = ($column == "password") ? bcrypt($value) : $value;
        $user->$column = $value;
      }
    }
    if ($user->update()) {
      if ($r->hasfile('image')) {
        $idUser = $user->id;
        $path = public_path() . "/users/{$idUser}";

        $nomeMainOmg = $image->getClientOriginalName();
        $image->move($path, "$nomeMainOmg");
        //actualizar y guardar la imagen del registro
        $rountMailImg = "/users/{$idUser}/$nomeMainOmg";
        $user->image = urlencode($rountMailImg);
        if (!$user->update()) {
          $save = false;
        }
      }
    } else {
      $save = false;
    }
    return( $user->update()) ? ["message" => "success"] : ["message" => "error"];
  }

  //ELIMINAR UN USUARIO
  public function delete($id, Request $r) {

    $user = User::find($id);
    $user->state = 2;
    return( $user->update()) ? ["message" => "success"] : ["message" => "error"];
  }

  //USUARIOS CON SUCURSAL
  public function withSubsidiary() {
    $users = User::where("subsidiary_id", "!=", "NULL")->with("profile")->with("subsidiary")->get();
    return (empty($users)) ? ["message" => "No se encontraron registros"] : $users;
  }

  //HISTORIA DE REGISTROS DE FACTURAS
  public function historyInvoice($id) {
    $user = User::with("invoices.invoiceReferences")->with("invoices.points")->find($id);
    return $user;
  }
  
  public function contactenos(Request $r) {
    $infoUser = $r->user();
    $email = json_decode($r->getContent(), true);
    $email['uname']=$infoUser->name;  
    $envio = Mail::to('andre0190@gmail.com')->send(new contactenos($email));
    print_r($envio);
  }

}
