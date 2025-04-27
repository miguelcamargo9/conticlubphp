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

//Password Recovery
Route::post("users/recover", 'API\UsersController@recover');
//Admin Routes
Route::group(['middleware' => ['auth:api']], function ($router) {
    Route::get("allprofiles", 'API\ProfilesController@allProfiles');
    //Users
    Route::get("users/all", 'API\UsersController@all');
    Route::get("users/getuser/{id}", 'API\UsersController@get');
    Route::post("users/update/{id}", 'API\UsersController@update');
    Route::get("users/withsubsidiary", 'API\UsersController@withSubsidiary');
    Route::get("users/historyinvoice/{id}", 'API\UsersController@historyInvoice');
    Route::get("users/historyInvoicebystate/{id}/{state}", 'API\UsersController@historyInvoiceByState');
    Route::put("users/delete/{id}", 'API\UsersController@delete');
    Route::post("users/contactenos", 'API\UsersController@contactenos');

    //Products
    Route::get("products/all", 'API\ProductsController@all');
    Route::post("products/create", 'API\ProductsController@create');
    Route::get("products/get/{id}", 'API\ProductsController@get');
    Route::post("products/update/{id}", 'API\ProductsController@update');
    Route::post("products/delete/{id}", 'API\ProductsController@delete');
    Route::get("products/byCategory/{idCategory}", 'API\ProductsController@getProductByCategory');
    Route::get("products/categories/all", 'API\ProductsController@getProductCategories');

    //Product Categories
    Route::get("product/category/all", 'API\ProductCategoriesController@all');
    Route::post("product/category/create", 'API\ProductCategoriesController@create');
    Route::get("product/category/get/{id}", 'API\ProductCategoriesController@get');
    Route::put("product/category/update/{id}", 'API\ProductCategoriesController@update');
    Route::delete("product/category/delete/{id}", 'API\ProductCategoriesController@delete');

    //Cities
    Route::get("city", 'API\CitiesController@all');
    Route::post("city", 'API\CitiesController@create');
    Route::get("city/{id}", 'API\CitiesController@get');
    Route::put("city/{id}", 'API\CitiesController@update');
    Route::delete("city/{id}", 'API\CitiesController@delete');

    //Profiles
    Route::get("profiles/all", 'API\ProfilesController@all');
    Route::post("profiles/create", 'API\ProfilesController@create');
    Route::get("profiles/get/{id}", 'API\ProfilesController@get');
    Route::put("profiles/update/{id}", 'API\ProfilesController@update');
    Route::delete("profiles/delete/{id}", 'API\ProfilesController@delete');
    Route::get('profiles/sellers', 'API\ProfilesController@getSellers')->name('profiles.sellers');


    //Subsidiaries
    Route::post("subsidiary", 'API\SubsidiariesController@create');
    Route::get("subsidiary/{id}", 'API\SubsidiariesController@get');
    Route::put("subsidiary/{id}", 'API\SubsidiariesController@update');
    Route::delete("subsidiary/{id}", 'API\SubsidiariesController@delete');

    //Brands
    Route::get("brand/all", 'API\BrandController@all');
    Route::post("brand/create", 'API\BrandController@create');
    Route::get("brand/get/{id}", 'API\BrandController@get');
    Route::put("brand/update/{id}", 'API\BrandController@update');
    Route::delete("brand/delete/{id}", 'API\BrandController@delete');


    //Designs
    Route::get("design", 'API\DesignController@all');
    Route::post("design", 'API\DesignController@create');
    Route::get("design/{id}", 'API\DesignController@get');
    Route::put("design/{id}", 'API\DesignController@update');
    Route::delete("design/{id}", 'API\DesignController@delete');
    Route::get("design/byBrand/{idBrand}", 'API\DesignController@getByBrand');

    //Slides
    Route::get("slides/all", 'API\SlidesController@all');
    Route::post("slides/create", 'API\SlidesController@create');
    Route::get("slides/get/{id}", 'API\SlidesController@get');
    Route::put("slides/update/{id}", 'API\SlidesController@update');
    Route::delete("slides/delete/{id}", 'API\SlidesController@delete');
    Route::get("slides/position/{position}/{responsive}", 'API\SlidesController@getByPosition');

    //Tires
    Route::get("tire", 'API\TireController@all');
    Route::post("tire", 'API\TireController@create');
    Route::get("tire/{id}", 'API\TireController@get');
    Route::put("tire/{id}", 'API\TireController@update');
    Route::delete("tire/{id}", 'API\TireController@delete');
    Route::get("tire/byDesign/{idDesign}", 'API\TireController@getByDesign');

    //Invoices
    Route::get("invoice/all", 'API\InvoiceController@all');
    Route::post("invoice/create", 'API\InvoiceController@create');
    Route::get("invoice/get/{id}", 'API\InvoiceController@get');
    Route::post("invoice/rejected/{id}", 'API\InvoiceController@rejected');
    Route::post("invoice/approved/{id}", 'API\InvoiceController@approved');
    Route::get("invoice/getbystate/{state}", 'API\InvoiceController@getByState');

    //Product change points
    Route::post("product/applyfor", 'API\ChangePointsController@applyFor');
    Route::post("product/approve/{id}", 'API\ChangePointsController@approve');
    Route::post("product/reject/{id}", 'API\ChangePointsController@reject');
    Route::post("product/buyed/{id}", 'API\ChangePointsController@buyed');
    Route::get("product/applyfor/all", 'API\ChangePointsController@all');
    Route::get("product/applyfor/getbyuser/{id}", 'API\ChangePointsController@GetbyUser');
    Route::get("product/applyfor/get/{id}", 'API\ChangePointsController@get');

    //Wish List
    Route::post("wishlist/create", 'API\WishListController@create');
    Route::get("wishlist/get/{id}", 'API\WishListController@get');
    Route::get("wishlist/all", 'API\WishListController@all');

    //Reports
    Route::get("reports/invoiceByUser", 'API\RerportController@invoicesByUsers');
});

//Protected routes by client key
Route::group(['middleware' => ['client']], function () {
    //Designs
    Route::get("subsidiary", 'API\SubsidiariesController@all');

    //Users
    Route::post("users/create", 'API\UsersController@create');
});



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
