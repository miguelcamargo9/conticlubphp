<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
//MODELOS
use App\Product;
use App\ProductImages;

class ProductsController extends BaseController {

  public function all() {
    $producs = Product::with("productCategory")->with("ProductImages")->get();
    return $producs;
  }

  public function create(Request $r) {
    
    //$infoProduct = json_decode($r->getContent(), true);
    $infoProduct = json_decode(Input::post("data"), true);
    $images = $r->file('images');
    $mainImage = $r->file('image');
    
    
    $newProduct = new Product();
    
    foreach ($infoProduct as $column=>$value){
      $newProduct->$column = $value;
    }
    
    
    if($newProduct->save()){
      $idProduct = $newProduct->id;
      $path = public_path()."/products/{$idProduct}";
      
      $nomeMainOmg = $mainImage->getClientOriginalName();
      $mainImage->move($path, "$nomeMainOmg");
      //actualizar y guardar la imagen del registro
      $rountMailImg = "{$path}/{$nomeMainOmg}";
      $rountMailImg = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $rountMailImg);
      $newProduct->image = $rountMailImg;
      $newProduct->update();
      if ($r->hasfile('images')) {
        foreach ($images as $file) {
          $name = $file->getClientOriginalName();
          $file->move($path, $name);
          $productImgs = new ProductImages();
          $routsImgs = "{$path}/{$name}";
          $routsImgs = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $routsImgs);
          $productImgs->image = $routsImgs;
          $productImgs->product_id = $idProduct;
          $productImgs->save();
        }
      }
    
    }
    return ["message"=>"success"];
    //$nombre = $documento->getClientOriginalName();
    //$documento->move("$idCaso/$idRegistro", "$nombre");
  }
  
   ///OBTENER UN PRODUCTO EXISTENTE
  public function get($id) {
    $product = Product::with("productCategory")->with("ProductImages")->find($id);
    return $product;
  }

}
