<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::filter('apiauth', function()
{
    if (Input::get('apikey') != Config::get('app.apikey'))
    {
	App::abort(401, 'You are not authorized.');
    }
});
Route::group(array('before' => 'apiauth'), function()
{
	Route::post('consultorio/buscar','ConsultorioController@postBuscar');
	Route::resource('consultorio', 'ConsultorioController');
	
	//Route::controller('odontologo','OdontologoController');
	Route::get('odontologo/{id}/centros-especialidades','OdontologoController@centros_especialidades');
	Route::post('odontologo/buscar','OdontologoController@postBuscar');
	Route::resource('odontologo', 'OdontologoController');

	//Route::controller('centro','CentroController');
	Route::post('centro/buscar','CentroController@postBuscar');
	Route::resource('centro', 'CentroController');
	
	//Route::controller('especialidad','EspecialidadController');
	Route::post('especialidad/buscar','EspecialidadController@postBuscar');
	Route::resource('especialidad', 'EspecialidadController');
	
	//Route::controller('centro-odontologo-especialidad','CentroOdontologoEspecialidadController');
	Route::post('centro-odontologo-especialidad/buscar','CentroOdontologoEspecialidadController@postBuscar');
	Route::resource('centro-odontologo-especialidad', 'CentroOdontologoEspecialidadController');

	Route::get('esquema/{modelo}', 'HerramientasController@getEsquema');
});

Route::get('/api',function()
{
    return View::make('hello');
});


Route::get('account', 'AccountController@showIndex'); 
Route::get('account/login', 'AccountController@showLogin'); 
Route::get('account/logout', 'AccountController@showLogout'); 
