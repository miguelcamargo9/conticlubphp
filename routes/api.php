<?php

use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */
Route::post('login', 'API\AccessTokenController@issueToken');
Route::get("perro", 'API\TestController@dog');
//RECUPERAR CONTRASEÑA DEL USUARIO
Route::post("users/recover", 'API\UsersController@recover');
//RUTAS PARA EL ADMINISTRADOR
Route::group(['middleware' => ['auth:api']], function($router) {

  Route::get("allprofiles", 'API\ProfilesController@allProfiles');
  //CRUD PARA LOS USUARIOS
  Route::get("users/all", 'API\UsersController@all');
  Route::post("users/create", 'API\UsersController@create');
  Route::get("users/getuser/{id}", 'API\UsersController@get');
  Route::post("users/update/{id}", 'API\UsersController@update');
  Route::get("users/withsubsidiary", 'API\UsersController@withSubsidiary');
  Route::get("users/historyinvoice/{id}", 'API\UsersController@historyInvoice');
  Route::get("users/historyInvoicebystate/{id}/{state}", 'API\UsersController@historyInvoiceByState');
  Route::put("users/delete/{id}", 'API\UsersController@delete');
  Route::post("users/contactenos", 'API\UsersController@contactenos');

  //PRODUCTOS
  Route::get("products/all", 'API\ProductsController@all');
  Route::post("products/create", 'API\ProductsController@create');
  Route::get("products/get/{id}", 'API\ProductsController@get');
  Route::post("products/update/{id}", 'API\ProductsController@update');
  Route::post("products/delete/{id}", 'API\ProductsController@delete');
  Route::get("products/byCategory/{idCategory}", 'API\ProductsController@getProductByCategory');
  Route::get("products/categories/all", 'API\ProductsController@getProductCategories');

  //PRODUCTS CATEGORIES
  Route::get("product/category/all", 'API\ProductCategoriesController@all');
  Route::post("product/category/create", 'API\ProductCategoriesController@create');
  Route::get("product/category/get/{id}", 'API\ProductCategoriesController@get');
  Route::put("product/category/update/{id}", 'API\ProductCategoriesController@update');
  Route::delete("product/category/delete/{id}", 'API\ProductCategoriesController@delete');

  //CIUDADES
  Route::get("cities/all", 'API\CitiesController@all');
  Route::post("cities/create", 'API\CitiesController@create');
  Route::get("cities/get/{id}", 'API\CitiesController@get');
  Route::post("cities/update/{id}", 'API\CitiesController@update');

  //PROFILES
  Route::get("profiles/all", 'API\ProfilesController@all');
  Route::post("profiles/create", 'API\ProfilesController@create');
  Route::get("profiles/get/{id}", 'API\ProfilesController@get');
  Route::put("profiles/update/{id}", 'API\ProfilesController@update');
  Route::delete("profiles/delete/{id}", 'API\ProfilesController@delete');

  //SUCURSALES
  Route::get("subsidiary/all", 'API\SubsidiariesController@all');
  Route::post("subsidiary/create", 'API\SubsidiariesController@create');
  Route::get("subsidiary/get/{id}", 'API\SubsidiariesController@get');
  Route::post("subsidiary/update/{id}", 'API\SubsidiariesController@update');
  Route::post("subsidiary/delete/{id}", 'API\SubsidiariesController@delete');

  //MARCAS
  Route::get("brand/all", 'API\BrandController@all');
  Route::post("brand/create", 'API\BrandController@create');
  Route::get("brand/get/{id}", 'API\BrandController@get');
  Route::post("brand/update/{id}", 'API\BrandController@update');
  Route::post("brand/delete/{id}", 'API\BrandController@delete');


  //DISEÑOS
  Route::get("design/all", 'API\DesignController@all');
  Route::post("design/create", 'API\DesignController@create');
  Route::get("design/get/{id}", 'API\DesignController@get');
  Route::post("design/update/{id}", 'API\DesignController@update');
  Route::post("design/delete/{id}", 'API\DesignController@delete');
  Route::get("design/byBrand/{idBrand}", 'API\DesignController@getByBrand');

  //SLIDES
  Route::get("slides/all", 'API\SlidesController@all');
  Route::post("slides/create", 'API\SlidesController@create');
  Route::get("slides/get/{id}", 'API\SlidesController@get');
  Route::put("slides/update/{id}", 'API\SlidesController@update');
  Route::delete("slides/delete/{id}", 'API\SlidesController@delete');
  Route::get("slides/position/{position}/{responsive}", 'API\SlidesController@getByPosition');

  //RINES
  Route::get("rin/all", 'API\RinController@all');
  Route::post("rin/create", 'API\RinController@create');
  Route::get("rin/get/{id}", 'API\RinController@get');
  Route::post("rin/update/{id}", 'API\RinController@update');
  Route::post("rin/delete/{id}", 'API\RinController@delete');
  Route::get("rin/byDesign/{idDesign}", 'API\RinController@getByDesign');

  //INVOICES
  Route::get("invoice/all", 'API\InvoiceController@all');
  Route::post("invoice/create", 'API\InvoiceController@create');
  Route::get("invoice/get/{id}", 'API\InvoiceController@get');
  Route::post("invoice/rejected/{id}", 'API\InvoiceController@rejected');
  Route::post("invoice/approved/{id}", 'API\InvoiceController@approved');
  Route::get("invoice/getbystate/{state}", 'API\InvoiceController@getByState');

  //CAMBIO DE PRODUCTOS
  Route::post("product/applyfor", 'API\ChangePointsController@applyFor');
  Route::post("product/approve/{id}", 'API\ChangePointsController@approve');
  Route::post("product/reject/{id}", 'API\ChangePointsController@reject');
  Route::post("product/buyed/{id}", 'API\ChangePointsController@buyed');
  Route::get("product/applyfor/all", 'API\ChangePointsController@all');
  Route::get("product/applyfor/getbyuser/{id}", 'API\ChangePointsController@GetbyUser');
  Route::get("product/applyfor/get/{id}", 'API\ChangePointsController@get');

  //LISTA DE DESEOS
   Route::post("wishlist/create", 'API\WishListController@create');
   Route::get("wishlist/get/{id}", 'API\WishListController@get');
   Route::get("wishlist/all", 'API\WishListController@all');

   //REPORTES
   Route::get("reportes/invoicebyuser", 'API\RerportController@invoicesByUsers');
});



Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});
