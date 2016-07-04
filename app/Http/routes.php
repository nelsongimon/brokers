<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('layouts.admin');
});

//Rutas del Frontend

Route::get('/hola','FrontController@index');


//Rutas del Backend

Route::group(['prefix'=>'admin'], function(){

	Route::resource('/usuarios','UsuariosController');
	Route::get('usuarios/{id}/destroy',[
		'uses'=>'UsuariosController@destroy',
		'as'=>'admin.usuarios.destroy'
		]);

	Route::resource('/asesores','AsesoresController');
	Route::get('asesores/{id}/destroy',[
		'uses'=>'asesoresController@destroy',
		'as'=>'admin.asesores.destroy'
		]);

});
