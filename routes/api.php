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
//RUTAS PARA EL ADMINISTRADOR
Route::group(['middleware' => ['auth:api']], function() {

  Route::get("allprofiles", 'API\ProfilesController@allProfiles');
  //CRUD PARA LOS USUARIOS
  Route::get("users/all", 'API\UsersController@all');
  Route::post("users/create", 'API\UsersController@create');
  Route::get("users/getuser/{id}", 'API\UsersController@get');
  Route::post("users/update/{id}", 'API\UsersController@update');

  //PRODUCTOS
  Route::get("producs/all", 'API\ProductsController@all');
  Route::post("producs/create", 'API\ProductsController@create');
  Route::get("producs/get/{id}", 'API\ProductsController@get');
  Route::post("producs/update/{id}", 'API\ProductsController@update');

  //CIUDADES
  Route::get("cities/all", 'API\CitiesController@all');
  Route::post("cities/create", 'API\CitiesController@create');
  Route::get("cities/get/{id}", 'API\CitiesController@get');
  Route::post("cities/update/{id}", 'API\CitiesController@update');


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
  
  //SLIDES
  Route::get("slides/all", 'API\SlidesController@all');
  Route::post("slides/create", 'API\SlidesController@create');
  Route::get("slides/get/{id}", 'API\SlidesController@get');
  Route::put("slides/update/{id}", 'API\SlidesController@update');

  //RINES
  Route::get("rin/all", 'API\RinController@all');
  Route::post("rin/create", 'API\RinController@create');
  Route::get("rin/get/{id}", 'API\RinController@get');
  Route::post("rin/update/{id}", 'API\RinController@update');
  Route::post("rin/delete/{id}", 'API\RinController@delete');
});



Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});
