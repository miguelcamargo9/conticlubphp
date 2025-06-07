<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

// Models
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class ProductCategoriesController extends BaseController
{
    use AuthorizesRequests,
      ValidatesRequests;

    //Get all Product Categories
    public function all()
    {
        return ProductCategory::all();
    }

    //Create a new Product Category
    public function create(Request $r): array
    {
        $productCategoryR = json_decode($r->getContent(), true);
        $productCategory = new ProductCategory();
        foreach ($productCategoryR as $column => $value) {
            $productCategory->$column = $value;
        }
        $productCategory->path = Str::slug($productCategory->name);
        return($productCategory->save()) ? ["message" => "success"] : ["message" => "error"];
    }

    //Get an existing Product Category
    public function get($id)
    {
        return ProductCategory::find($id);
    }

    //Update a Product Category
    public function update($id, Request $r): array
    {
        $productCategoryR = json_decode($r->getContent(), true);
        $productCategory = ProductCategory::find($id);
        foreach ($productCategoryR as $column => $value) {
            $productCategory->$column = $value;
        }
        return($productCategory->update()) ? ["message" => "success"] : ["message" => "error"];
    }
    //delete an existing Product Category
    public function delete($id): array
    {
        $productCategory = ProductCategory::find($id);
        try {
            $productCategory->delete();
            return["message" => "success"];
        } catch (QueryException $e) {
            $error = $e->errorInfo;
            return ($error[0] == "23000") ?
                ["message" => "error", "detail" => "Esta categoría esta siendo usada en uno o más producto"] :
                ["message" => "error", "detail" => $error[2]];
        } catch (Exception $e) {
            return ["message" => "error", "detail" => $e->getMessage()];
        }
    }
}
