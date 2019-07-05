<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;


Use App\WishList;

class WishListController extends BaseController {

  public function create(Request $r) {
    $infoUser = $r->user();

    $data = json_decode($r->getContent(), true);
    $wishList = new WishList();
    $wishList->users_id = $infoUser->id;
    foreach ($data as $column => $value) {
      $wishList->$column = $value;
    }
    return( $wishList->save()) ? ["message" => "success"] : ["message" => "error"];
  }
  
  //DEVOLVER LA LISTA DE DESEOS DE UN USUARIO
  public function get($id) {
    $wishList = WishList::where("users_id",$id)->with("product")->get();
    return $wishList;
  }
  
  //DEVOLVER TODAS LAS LISTAS DE DESEOS
  public function all() {
    $wishList = WishList::with(["product","user:id,name"])->get();
    return $wishList;
  }

}
