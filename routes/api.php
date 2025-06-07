<?php

use App\Http\Controllers\API\AccessTokenController;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\ChangePointsController;
use App\Http\Controllers\API\CitiesController;
use App\Http\Controllers\API\DesignController;
use App\Http\Controllers\API\InvoiceController;
use App\Http\Controllers\API\ProductCategoriesController;
use App\Http\Controllers\API\ProductsController;
use App\Http\Controllers\API\ProfilesController;
use App\Http\Controllers\API\ReportController;
use App\Http\Controllers\API\SlidesController;
use App\Http\Controllers\API\SubsidiariesController;
use App\Http\Controllers\API\TireController;
use App\Http\Controllers\API\UsersController;
use App\Http\Controllers\API\WishListController;
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
Route::post('login', [AccessTokenController::class, 'issueToken']);

//Password Recovery
Route::post("users/recover", [UsersController::class, 'recover']);
//Admin Routes
Route::group(['middleware' => ['auth:api']], function () {
    Route::get("allprofiles", [ProfilesController::class, 'allProfiles']);
    //Users
    Route::get("users/all", [UsersController::class, 'all']);
    Route::get("users/getuser/{id}", [UsersController::class, 'get']);
    Route::post("users/update/{id}", [UsersController::class, 'update']);
    Route::get("users/withsubsidiary", [UsersController::class, 'withSubsidiary']);
    Route::get("users/historyinvoice/{id}", [UsersController::class, 'historyInvoice']);
    Route::get("users/historyInvoicebystate/{id}/{state}", [UsersController::class, 'historyInvoiceByState']);
    Route::put("users/delete/{id}", [UsersController::class, 'delete']);
    Route::post("users/contactenos", [UsersController::class, 'contactenos']);

    //Products
    Route::get("products/all", [ProductsController::class, 'all']);
    Route::post("products/create", [ProductsController::class, 'create']);
    Route::get("products/get/{id}", [ProductsController::class, 'get']);
    Route::post("products/update/{id}", [ProductsController::class, 'update']);
    Route::post("products/delete/{id}", [ProductsController::class, 'delete']);
    Route::get("products/byCategory/{idCategory}", [ProductsController::class, 'getProductByCategory']);
    Route::get("products/categories/all", [ProductsController::class, 'getProductCategories']);

    //Product Categories
    Route::get("product/category/all", [ProductCategoriesController::class, 'all']);
    Route::post("product/category/create", [ProductCategoriesController::class, 'create']);
    Route::get("product/category/get/{id}", [ProductCategoriesController::class, 'get']);
    Route::put("product/category/update/{id}", [ProductCategoriesController::class, 'update']);
    Route::delete("product/category/delete/{id}", [ProductCategoriesController::class, 'delete']);

    //Cities
    Route::get("city", [CitiesController::class, 'all']);
    Route::post("city", [CitiesController::class, 'create']);
    Route::get("city/{id}", [CitiesController::class, 'get']);
    Route::put("city/{id}", [CitiesController::class, 'update']);
    Route::delete("city/{id}", [CitiesController::class, 'delete']);

    //Profiles
    Route::get("profiles/all", [ProfilesController::class, 'all']);
    Route::post("profiles/create", [ProfilesController::class, 'create']);
    Route::get("profiles/get/{id}", [ProfilesController::class, 'get']);
    Route::put("profiles/update/{id}", [ProfilesController::class, 'update']);
    Route::delete("profiles/delete/{id}", [ProfilesController::class, 'delete']);
    Route::get('profiles/sellers', [ProfilesController::class, 'getSellers'])->name('profiles.sellers');


    //Subsidiaries
    Route::post("subsidiary", [SubsidiariesController::class, 'create']);
    Route::get("subsidiary/{id}", [SubsidiariesController::class, 'get']);
    Route::put("subsidiary/{id}", [SubsidiariesController::class, 'update']);
    Route::delete("subsidiary/{id}", [SubsidiariesController::class, 'delete']);

    //Brands
    Route::get("brand/all", [BrandController::class, 'all']);
    Route::post("brand/create", [BrandController::class, 'create']);
    Route::get("brand/get/{id}", [BrandController::class, 'get']);
    Route::put("brand/update/{id}", [BrandController::class, 'update']);
    Route::delete("brand/delete/{id}", [BrandController::class, 'delete']);


    //Designs
    Route::get("design", [DesignController::class, 'all']);
    Route::post("design", [DesignController::class, 'create']);
    Route::get("design/{id}", [DesignController::class, 'get']);
    Route::put("design/{id}", [DesignController::class, 'update']);
    Route::delete("design/{id}", [DesignController::class, 'delete']);
    Route::get("design/byBrand/{idBrand}", [DesignController::class, 'getByBrand']);

    //Slides
    Route::get("slides/all", [SlidesController::class, 'all']);
    Route::post("slides/create", [SlidesController::class, 'create']);
    Route::get("slides/get/{id}", [SlidesController::class, 'get']);
    Route::put("slides/update/{id}", [SlidesController::class, 'update']);
    Route::delete("slides/delete/{id}", [SlidesController::class, 'delete']);
    Route::get("slides/position/{position}/{responsive}", [SlidesController::class, 'getByPosition']);

    //Tires
    Route::get("tire", [TireController::class, 'all']);
    Route::post("tire", [TireController::class, 'create']);
    Route::get("tire/{id}", [TireController::class, 'get']);
    Route::put("tire/{id}", [TireController::class, 'update']);
    Route::delete("tire/{id}", [TireController::class, 'delete']);
    Route::get("tire/byDesign/{idDesign}", [TireController::class, 'getByDesign']);

    //Invoices
    Route::get("invoice/all", [InvoiceController::class, 'all']);
    Route::post("invoice/create", [InvoiceController::class, 'create']);
    Route::get("invoice/get/{id}", [InvoiceController::class, 'get']);
    Route::post("invoice/rejected/{id}", [InvoiceController::class, 'rejected']);
    Route::post("invoice/approved/{id}", [InvoiceController::class, 'approved']);
    Route::get("invoice/getbystate/{state}", [InvoiceController::class, 'getByState']);

    //Product change points
    Route::post("product/applyfor", [ChangePointsController::class, 'applyFor']);
    Route::post("product/approve/{id}", [ChangePointsController::class, 'approve']);
    Route::post("product/reject/{id}", [ChangePointsController::class, 'reject']);
    Route::post("product/bought/{id}", [ChangePointsController::class, 'bought']);
    Route::get("product/applyfor/all", [ChangePointsController::class, 'all']);
    Route::get("product/applyfor/getbyuser/{id}", [ChangePointsController::class, 'getByUser']);
    Route::get("product/applyfor/get/{id}", [ChangePointsController::class, 'get']);

    //Wish List
    Route::post("wishlist/create", [WishListController::class, 'create']);
    Route::get("wishlist/get/{id}", [WishListController::class, 'get']);
    Route::get("wishlist/all", [WishListController::class, 'all']);

    //Reports
    Route::get("reports/invoiceByUser", [ReportController::class, 'invoicesByUsers']);
    Route::get('reports/invoices/full', [ReportController::class, 'fullInvoicesReport']);
});

//Protected routes by client key
Route::group(['middleware' => ['client']], function () {
    //Designs
    Route::get("subsidiary", [SubsidiariesController::class, 'all']);

    //Users
    Route::post("users/create", [UsersController::class, 'create']);
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
