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


//Rutas del Frontend --------------------------------------------------------

Route::get('/','FrontController@index');


Route::get('/busqueda-avanzada', 'FrontController@FormBusquedaAvanzada');

Route::get('/propiedades/{id}/{titulo}', 'FrontController@detallesInmuebles');

Route::get('/resultados',[
	'uses' => 'FrontController@busquedaRapida',
	'as'   => 'front.busquedaRapida'
	]);

Route::get('/busqueda',[
	'uses' => 'FrontController@busquedaAvanzada',
	'as'   => 'front.busquedaAvanzada'
	]);

Route::get('/asesores','FrontController@showAsesores');

Route::get('/empleo','FrontController@empleo');

Route::get('/pasos-para-vender','FrontController@pasosVender');

Route::post('formulario-empleo',[
	'uses' => 'FrontController@formEmpleo',
	'as'   => 'front.empleo'

	]);


Route::get('/br-admin',function(){ 
	return redirect('/admin/home');
});

Route::get('/login','FrontController@login');
Route::post('/login',[
	'uses'=>'FrontController@loginAuth', 
	'as'=>'front.login'
	]);

Route::get('password/email','Auth\PasswordController@getEmail');
Route::post('password/email','Auth\PasswordController@postEmail');

Route::get('password/reset/{token}','Auth\PasswordController@getReset');
Route::post('password/reset','Auth\PasswordController@postReset');

Route::post('front/estados/ciudades',[
			'uses' => 'FrontController@estadosCiudades',
			'as'   => 'front.estadosCiudades'
		]);

Route::post('front/ciudades/sectores',[
			'uses' => 'FrontController@ciudadesSectores',
			'as'   => 'front.ciudadesSectores'
		]);

Route::get('/logout','FrontController@logout');

Route::get('/{filtrado}','FrontController@filtrado');




//Rutas del Backend ---------------------------------------------------------

Route::group(['prefix'=>'admin', 'middleware' => 'auth'], function(){

	Route::get('/home','HomeController@index');

	Route::get('/perfil','HomeController@perfil');

	Route::resource('/usuarios','UsuariosController');
	Route::get('usuarios/{id}/destroy',[
		'uses' => 'UsuariosController@destroy',
		'as'   => 'admin.usuarios.destroy'
		]);


	Route::resource('/asesores','AsesoresController');
	Route::get('asesores/{id}/destroy',[
		'uses' => 'asesoresController@destroy',
		'as'   => 'admin.asesores.destroy'
		]);



	Route::group(['prefix'=>'ajustes'], function(){
		
		Route::get('/precio-dolar','AjustesController@mostrarPrecioDolar');

		Route::post('/precio-dolar',[
				'uses' => 'AjustesController@updatePrecioDolar',
				'as'   => 'admin.ajustes.precio.update'
			]);

		Route::get('/tipos-de-inmuebles','AjustesController@mostrarTipos');

		Route::post('/tipos-de-inmuebles',[
				'uses' => 'AjustesController@createTipos',
				'as'   => 'admin.ajustes.tipos.create'
			]);
		Route::get('/tipos-de-inmuebles/{id}/edit',[
				'uses' => 'AjustesController@editTipos',
				'as'   => 'admin.ajustes.tipos.edit'
			]);
		Route::put('/tipos-de-inmuebles/update',[
				'uses' => 'AjustesController@updateTipos',
				'as'   => 'admin.ajustes.tipos.update'
			]);
		Route::get('/tipos-de-inmuebles/{id}/delete',[
				'uses' => 'AjustesController@deleteTipos',
				'as'   => 'admin.ajustes.tipos.delete'
			]);


		Route::get('/tipos-de-negociacion','AjustesController@mostrarNegociacion');

		Route::post('/tipos-de-negociacion',[
				'uses' => 'AjustesController@createNegociacion',
				'as'   => 'admin.ajustes.negociacion.create'
			]);
		Route::get('/tipos-de-negociacion/{id}/edit',[
				'uses' => 'AjustesController@editNegociacion',
				'as'   => 'admin.ajustes.negociacion.edit'
			]);
		Route::put('/tipos-de-negociacion/update',[
				'uses' => 'AjustesController@updateNegociacion',
				'as'   => 'admin.ajustes.negociacion.update'
			]);
		Route::get('/tipos-de-negociacion/{id}/delete',[
				'uses' => 'AjustesController@deleteNegociacion',
				'as'   => 'admin.ajustes.negociacion.delete'
			]);

		Route::get('/slider','AjustesController@mostrarSlider');
		Route::get('/destacados','AjustesController@mostrarDestacados');


	});


	Route::group(['prefix'=>'localizacion'], function(){

		Route::resource('estados','EstadosController');
		Route::get('estados/{id}/destroy',[
			'uses' => 'EstadosController@destroy',
			'as'   => 'admin.localizacion.estados.destroy'
		]);

		Route::resource('ciudades','CiudadesController');
		Route::get('ciudades/{id}/destroy',[
			'uses' => 'CiudadesController@destroy',
			'as'   => 'admin.localizacion.ciudades.destroy'
		]);

		Route::resource('sectores','SectoresController');
		Route::get('sectores/{id}/destroy',[
			'uses' => 'SectoresController@destroy',
			'as'   => 'admin.localizacion.sectores.destroy'
		]);

		Route::post('sectores/estados/ciudades',[
			'uses' => 'SectoresController@estadosCiudades',
			'as'   => 'admin.localizacion.sectores.estadosCiudades'
		]);

		Route::post('estados/ciudades/sectores',[
			'uses' => 'SectoresController@ciudadesSectores',
			'as'   => 'admin.localizacion.sectores.ciudadesSectores'
		]);
	});


	Route::resource('/inmuebles','InmueblesController');
	Route::get('inmuebles/{id}/destroy',[
		'uses' => 'InmueblesController@destroy',
		'as'   => 'admin.inmuebles.destroy'
		]);
	Route::post('inmuebles/create',[
		'uses' => 'InmueblesController@storeLocalizacion',
		'as'   => 'admin.inmuebles.storeLocalizacion'
		]);
	Route::post('inmuebles/create/imagenes',[
		'uses' => 'InmueblesController@storeImagenes',
		'as'   => 'admin.inmuebles.storeImagenes'
		]);

	Route::get('inmuebles/create/localizacion',[
		'uses' => 'InmueblesController@createLocalizacion',
		'as'   => 'admin.inmuebles.createLocalizacion'
		]);
	Route::post('inmuebles/edit-imagenes',[
		'uses' => 'InmueblesController@editImagenes',
		'as'   => 'admin.inmuebles.editImagenes'
		]);
	Route::post('inmuebles/update-imagenes',[
		'uses' => 'InmueblesController@updateImagenes',
		'as'   => 'admin.inmuebles.updateImagenes'
		]);
	Route::get('inmuebles/create/imagenes','InmueblesController@createImagenes');
	Route::post('inmuebles/update/status',[
		'uses' => 'InmueblesController@updateStatus',
		'as'   => 'admin.inmuebles.updateStatus'
		]);


	Route::resource('/aspirantes','AspirantesController');
	Route::get('aspirantes/{id}/destroy',[
		'uses' => 'AspirantesController@destroy',
		'as'   => 'admin.aspirantes.destroy'
		]);

	Route::resource('/destacados','DestacadosController');
	Route::get('slider/{id}/destroy',[
		'uses' => 'DestacadosController@destroySlider',
		'as'   => 'admin.slider.destroy'
		]);
	Route::get('destacados/{id}/destroy',[
		'uses' => 'DestacadosController@destroyDestacados',
		'as'   => 'admin.destacados.destroy'
		]);

	Route::post('/editPerfil',[
		'uses' => 'HomeController@updatePerfil',
		'as'   => 'admin.home.perfil'
		]);

});




