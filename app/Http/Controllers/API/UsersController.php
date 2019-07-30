<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Mail\Contactenos;
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
    $user = User::with("invoices.invoiceReferences.rin.design.brand")->with("invoices.points")->find($id);
    return $user;
  }

  public function contactenos(Request $r) {
    $infoUser = $r->user();
    $datos = json_decode($r->getContent(), true);
    $datos['uname'] = $infoUser->name;
    try {
//      Mail::to("miguelcamargo9@gmail.com")->send(new Contactenos($datos));
      Mail::to("conticlub@lupdup.com, carloslopez@introcrea.com")->send(new Contactenos($datos));
      return ["message" => "success"];
    } catch (Exception $e) {
      return ["message" => "success"];
    }
  }
  
  private function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 6; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
  
  //RECUPERAR UNA CONTRASEÑA
  public function recover(Request $r) {
      $data  = json_decode($r->getContent(), true);
      $user = User::where([["email",$data['email']],["identification_number",$data['identification_number']]])->get();
      $exitUser = User::where([["email"=>$data['email']],["identification_number"=>$data['identification_number']]])->count();
      if($exitUser>0){
            try {
            $datos['name'] = $user->name;
            $datos['passwd'] = $this->randomPassword();
            $user->password = bcrypt($datos['passwd']);
            if($user->update()){
                Mail::to($user->email)->send(new Recover($datos));
                return ["message" => "success"];
            }else{
                return ["message" => "error"];
            }
          } catch (Exception $e) {
            return ["message" => "error"];
          }
      }else{
          return ["message" => "error","detail"=>"No se encontro usuario con esos datos"];
      }
  }
  
}
