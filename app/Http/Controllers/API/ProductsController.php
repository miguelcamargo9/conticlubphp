<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
//MODELOS
use App\Product;
use App\ProductImages;
use App\ProductCategories;

class ProductsController extends BaseController {

  public function all() {
    $producs = Product::where("state","1")->with("productCategory")->get();
    return $producs;
  }

  public function create(Request $r) {
    
    //$infoProduct = json_decode($r->getContent(), true);
    $infoProduct = json_decode(Input::post("data"), true);
    $images = $r->file('images');
    $mainImage = $r->file('image');
    $idCategory = $infoProduct['product_categories_id'];
    
    
    $newProduct = new Product();
    
    foreach ($infoProduct as $column=>$value){
      $newProduct->$column = $value;
    }
    
    $category = ProductCategories::find($idCategory);
    $ameCategory = $category->name;

    if($newProduct->save()){
      $idProduct = $newProduct->id;
      $path = public_path()."/products/$ameCategory/{$idProduct}";
      
      $nomeMainOmg = $mainImage->getClientOriginalName();
      $mainImage->move($path, "$nomeMainOmg");
      //actualizar y guardar la imagen del registro
      $rountMailImg = "/products/$ameCategory/{$idProduct}/$nomeMainOmg";
      $newProduct->image = urlencode($rountMailImg);
      $newProduct->update();
      if ($r->hasfile('images')) {
        foreach ($images as $file) {
          $name = $file->getClientOriginalName();
          $file->move($path, $name);
          $productImgs = new ProductImages();
          $routsImgs = "/products/$ameCategory/{$idProduct}/$nomeMainOmg";
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
    $product = Product::with("productCategory")->find($id);
    return $product;
  }
  
  //Obetenr un producto por idCategory
  public function getProductByCategory($idCategory) {
    $products = Product::with("productCategory")->where([["product_categories_id","=",$idCategory],["state","1"]])->get();
    return $products;
  }
  
  public function getProductCategories() {
    return ProductCategories::all();
  }
  
  //ACTIALIZAR UN PRODUCTO
  public function update($id, Request $r) {
    //$data = json_decode($r->getContent(), true);
    $data = json_decode(Input::post("data"), true);
   
    $product = Product::find($id);
    $idCategory= $product->product_categories_id;
    $category = ProductCategories::find($idCategory);
    
    $nameCategory = $category['name'];
    
    foreach ($data as $column => $value) {
      $product->$column = $value;
    }
    if ($r->hasfile('image')) {
      $img = $r->file('image');
      $idProduct = $product->id;
      $path = public_path()."/products/$nameCategory/{$idProduct}";
      
      $nomeMainOmg = $img->getClientOriginalName();
      $img->move($path, "$nomeMainOmg");
      //actualizar y guardar la imagen del registro
      $rountMailImg = "/products/$nameCategory/{$idProduct}/$nomeMainOmg";
      $product->image = urlencode($rountMailImg);
      $product->image = $rountMailImg;
    }
    return( $product->update()) ? ["message" => "success"] : ["message" => "error"];
  }
  
  public function delete($id) {
    $product = Product::find($id);
    $product->state=2;
    return( $product->update()) ? ["message" => "success"] : ["message" => "error"];
  }

}
