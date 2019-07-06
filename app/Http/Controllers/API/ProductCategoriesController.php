<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\ProductCategories;

class ProductCategoriesController extends BaseController {

  use AuthorizesRequests,
      ValidatesRequests;

  //Get all Product Categories
  public function all() {
    $productCategories = ProductCategories::all();
    return $productCategories;
  }

  //Create a new Product Category
  public function create(Request $r) {
    $productCategoryR = json_decode($r->getContent(), true);
    $productCategory = new ProductCategories();
    foreach ($productCategoryR as $column => $value) {
      $productCategory->$column = $value;
    }
    return( $productCategory->save()) ? ["message" => "success"] : ["message" => "error"];
  }

  //Get an existing Product Category
  public function get($id) {
    $productCategory = ProductCategories::find($id);
    return $productCategory;
  }

  //Update a Product Category
  public function update($id, Request $r) {
    $productCategoryR = json_decode($r->getContent(), true);
    $productCategory = ProductCategories::find($id);
    foreach ($productCategoryR as $column => $value) {
      $productCategory->$column = $value;
    }
    return( $productCategory->update()) ? ["message" => "success"] : ["message" => "error"];
  }
    //delete an existing Product Category
  public function delete($id) {
    $productCategory = ProductCategories::find($id);
    try {
      $productCategory->delete();
      return["message" => "success"];
    } catch (\Illuminate\Database\QueryException $e) {
      $error = $e->errorInfo;
      return ($error[0] == "23000") ? ["message" => "error", "detail" => "Esta categoría esta siendo usada en uno o más producto"] : ["message" => "error", "detail" => $error[2]];
    }
  }

}
