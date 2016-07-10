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



//Rutas del Frontend

Route::get('/','FrontController@index');
Route::get('/login','FrontController@login');


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

	Route::group(['prefix'=>'ajustes'], function(){
		
		Route::get('/precio-dolar','AjustesController@mostrarPrecioDolar');

		Route::post('/precio-dolar',[
				'uses'=>'AjustesController@updatePrecioDolar',
				'as'=>'admin.ajustes.precio.update'
			]);

		Route::get('/tipos-de-inmuebles','AjustesController@mostrarTipos');

		Route::post('/tipos-de-inmuebles',[
				'uses'=>'AjustesController@createTipos',
				'as'=>'admin.ajustes.tipos.create'
			]);
		Route::get('/tipos-de-inmuebles/{id}/edit',[
				'uses'=>'AjustesController@editTipos',
				'as'=>'admin.ajustes.tipos.edit'
			]);
		Route::put('/tipos-de-inmuebles/update',[
				'uses'=>'AjustesController@updateTipos',
				'as'=>'admin.ajustes.tipos.update'
			]);
		Route::get('/tipos-de-inmuebles/{id}/delete',[
				'uses'=>'AjustesController@deleteTipos',
				'as'=>'admin.ajustes.tipos.delete'
			]);

/*****************************************************************************************/

		Route::get('/tipos-de-negociacion','AjustesController@mostrarNegociacion');

		Route::post('/tipos-de-negociacion',[
				'uses'=>'AjustesController@createNegociacion',
				'as'=>'admin.ajustes.negociacion.create'
			]);
		Route::get('/tipos-de-negociacion/{id}/edit',[
				'uses'=>'AjustesController@editNegociacion',
				'as'=>'admin.ajustes.negociacion.edit'
			]);
		Route::put('/tipos-de-negociacion/update',[
				'uses'=>'AjustesController@updateNegociacion',
				'as'=>'admin.ajustes.negociacion.update'
			]);
		Route::get('/tipos-de-negociacion/{id}/delete',[
				'uses'=>'AjustesController@deleteNegociacion',
				'as'=>'admin.ajustes.negociacion.delete'
			]);


	});

});
