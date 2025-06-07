<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

// Models
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;

class ProductsController extends BaseController
{

    public function all()
    {
        return Product::where("state", "1")->with("productCategory")->get();
    }

    public function create(Request $req)
    {
        //$infoProduct = json_decode($r->getContent(), true);
        $infoProduct = json_decode(Input::post("data"), true);
        $images = $req->file('images');
        $mainImage = $req->file('image');
        $idCategory = $infoProduct['product_categories_id'];

        $newProduct = new Product();

        foreach ($infoProduct as $column => $value) {
            $newProduct->$column = $value;
        }

        $category = ProductCategory::find($idCategory);
        $ameCategory = $category->path;

        if ($newProduct->save()) {
            $idProduct = $newProduct->id;

            // Almacenar el archivo en S3 dentro de la carpeta 'products'
            $path = "/files/products/$ameCategory/$idProduct/$idProduct-{$mainImage->getClientOriginalName()}";
            Storage::disk('s3')->put($path, file_get_contents($mainImage));

            //actualizar y guardar la imagen del registro
            $newProduct->image = urlencode($path);
            $newProduct->update();
            if ($req->hasfile('images')) {
                foreach ($images as $file) {
                    // Almacenar el archivo en S3 dentro de la carpeta 'products'
                    $path = "/files/products/$ameCategory/$idProduct/$idProduct-{$file->getClientOriginalName()}";
                    Storage::disk('s3')->put($path, file_get_contents($file));

                    $productImages = new ProductImage();
                    $productImages->image = $path;
                    $productImages->product_id = $idProduct;
                    $productImages->save();
                }
            }
        }
        return ["message" => "success"];
        //$nombre = $documento->getClientOriginalName();
        //$documento->move("$idCaso/$idRegistro", "$nombre");
    }

    ///OBTENER UN PRODUCTO EXISTENTE
    public function get($id)
    {
        return Product::with("productCategory")->find($id);
    }

    //Obtener un producto por idCategory
    public function getProductByCategory($idCategory)
    {
        return Product::with("productCategory")
            ->where([["product_categories_id", "=", $idCategory], ["state", "1"]])->get();
    }

    public function getProductCategories()
    {
        return ProductCategory::all();
    }

    //ACTUALIZAR UN PRODUCTO
    public function update($id, Request $req)
    {
        //$data = json_decode($r->getContent(), true);
        $data = json_decode(Input::post("data"), true);

        $product = Product::find($id);
        $idCategory = $product->product_categories_id;
        $category = ProductCategory::find($idCategory);

        $pathCategory = $category['path'];

        foreach ($data as $column => $value) {
            $product->$column = $value;
        }
        if ($req->hasfile('image')) {
            $img = $req->file('image');
            $idProduct = $product->id;

            // Almacenar el archivo en S3 dentro de la carpeta 'products'
            $path = "/files/products/$pathCategory/$idProduct/$idProduct-{$img->getClientOriginalName()}";
            Storage::disk('s3')->put($path, file_get_contents($img));

            //actualizar y guardar la imagen del registro
            $product->image = $path;
        }
        return ($product->update()) ? ["message" => "success"] : ["message" => "error"];
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->state = 2;
        return ($product->update()) ? ["message" => "success"] : ["message" => "error"];
    }
}
