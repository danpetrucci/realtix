<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('/auth/login');
});
Route::get('/home', 'HomeController@index');

Auth::routes();

/*Rutas de usuarios*/

Route::get('/user', 'UserController@index');
Route::get('/user/search/', 'UserController@search');
Route::get('/user/edit/{id}', 'UserController@show');
Route::post('/user/destroy/{id}', 'UserController@destroy');

Route::get('/user/create', 'UserController@create');

Route::post('/user/store', 'UserController@store');

Route::post('/user/update', 'UserController@update');

/*Rutas de Inmobiliarias CRUD*/

Route::resource('inmobiliaria', 'InmobiliariasController');
Route::post('/inmobiliaria/search/', 'InmobiliariasController@search');

/*Rutas de Inmueble CRUD*/
Route::resource('inmueble', 'InmuebleController');
Route::post('/inmueble/search/', 'InmuebleController@search');

/*Rutas Pais, Departamento y municipio*/
Route::get('geo/paises','GeoController@paises');
Route::get('/geo/departamentos/{id}','GeoController@departamentos');
Route::get('/geo/municipios/{id}','GeoController@municipios');
