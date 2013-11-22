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

	Route::post('paciente/{id}/prepagas/{prepaga_id}','PacienteController@setPrepaga');
	Route::delete('paciente/{id}/prepagas/{prepaga_id}','PacienteController@unsetPrepaga');
	Route::get('paciente/{id}/prepagas','PacienteController@prepagas');
	Route::post('paciente/buscar','PacienteController@postBuscar');
	Route::resource('paciente', 'PacienteController');

	Route::post('prepaga/{id}/pacientes/{paciente_id}','PrepagaController@setPaciente');
	Route::delete('prepaga/{id}/pacientes/{paciente_id}','PrepagaController@unsetPaciente');
	Route::get('prepaga/{id}/pacientes','PrepagaController@pacientes');
	Route::post('pprepaga/buscar','PrepagaController@postBuscar');
	Route::resource('prepaga', 'PrepagaController');

	//Route::controller('centro','CentroController');
	Route::post('centro/buscar','CentroController@postBuscar');
	Route::resource('centro', 'CentroController');
	
	//Route::controller('especialidad','EspecialidadController');
	Route::post('especialidad/buscar','EspecialidadController@postBuscar');
	Route::resource('especialidad', 'EspecialidadController');
	
	//Route::controller('centro-odontologo-especialidad','CentroOdontologoEspecialidadController');
	Route::get('centro-odontologo-especialidad/agendas','CentroOdontologoEspecialidadController@generarAgendas');
	Route::get('centro-odontologo-especialidad/{id}/agendas','CentroOdontologoEspecialidadController@agendas');
	Route::get('centro-odontologo-especialidad/detalle','CentroOdontologoEspecialidadController@vista_detallada');
	Route::post('centro-odontologo-especialidad/buscar','CentroOdontologoEspecialidadController@postBuscar');
	Route::resource('centro-odontologo-especialidad', 'CentroOdontologoEspecialidadController');

	Route::post('agenda/buscar','AgendaController@postBuscar');
	Route::resource('agenda', 'AgendaController');
	
	Route::get('esquema/{modelo}', 'HerramientasController@getEsquema');
});

Route::get('/api',function()
{
    return View::make('hello');
});


Route::get('account', 'AccountController@showIndex'); 
Route::get('account/login', 'AccountController@showLogin'); 
Route::get('account/logout', 'AccountController@showLogout'); 
