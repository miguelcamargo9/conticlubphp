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
Route::group(['middleware'=>['auth:api']], function() {
  
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
});



Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});
