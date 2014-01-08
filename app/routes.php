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

Route::filter('usuarioauth', function()
{
	$u = User::where("session_key","=",Input::get("session_key"))->where("session_expira",">=",date("Y-m-d H:i:s"))->get();
	if (count($u)==0)
	    {
		App::abort(401, 'You are not authorized.');
	    }
	Auth::loginUsingId($u[0]->id);
});

Route::group(array('bafore' => 'apiauth'),function()
{
	Route::post('usuario/login','UserController@validar');	
});
Route::group(array('before' => 'apiauth|usuarioauth'), function()
{
	Route::post('consultorio/buscar','ConsultorioController@postBuscar');
	Route::resource('consultorio', 'ConsultorioController');
	
	//Route::controller('odontologo','OdontologoController');
	Route::get('odontologo/{id}/ausencias','OdontologoController@ver_ausencias');
	Route::get('odontologo/{id}/centros-especialidades','OdontologoController@centros_especialidades');
	Route::post('odontologo/buscar','OdontologoController@postBuscar');
	Route::resource('odontologo', 'OdontologoController');

	//Route::post('paciente/{id}/prepagas/{prepaga_id}','PacienteController@setPrepaga');
	Route::resource('tipo-observaciones-pacientes', 'TipoObservacionesController');

	Route::resource('observaciones-pacientes', 'ObservacionPacienteController');

	Route::resource('ausencias-odontologos', 'AusenciaOdontologoController');

	//Route::delete('paciente/{id}/prepagas/{prepaga_id}','PacienteController@unsetPrepaga');
	Route::get('paciente/{paciente_id}/observaciones','ObservacionPacienteController@vista_detallada');
	Route::get('paciente/{paciente_id}/prepaga','PacientePrepagaController@vista_detallada');
	//Route::get('paciente/{id}/prepagas','PacienteController@prepagas');
	Route::post('paciente/buscar','PacienteController@postBuscar');
	Route::resource('paciente', 'PacienteController');

	//Route::post('prepaga/{id}/pacientes/{paciente_id}','PrepagaController@setPaciente');
	//Route::delete('prepaga/{id}/pacientes/{paciente_id}','PrepagaController@unsetPaciente');
	Route::get('prepaga/{id}/pacientes','PrepagaController@pacientes');
	Route::post('prepaga/buscar','PrepagaController@postBuscar');
	Route::resource('prepaga', 'PrepagaController');

	Route::post('paciente-prepaga/{paciente_prepaga_id}/tomar-turno','PacientePrepagaController@tomar_turno');
	Route::post('paciente-prepaga/buscar','PacientePrepagaController@postBuscar');
	Route::resource('paciente-prepaga','PacientePrepagaController');

	//Route::controller('centro','CentroController');
	Route::post('centro/buscar','CentroController@postBuscar');
	Route::resource('centro', 'CentroController');
	
	//Route::controller('especialidad','EspecialidadController');
	Route::get('especialidad/{especialidad_id}/turnos-libres','EspecialidadController@turnos_libres');
	Route::post('especialidad/buscar','EspecialidadController@postBuscar');
	Route::resource('especialidad', 'EspecialidadController');
	
	//Route::controller('centro-odontologo-especialidad','CentroOdontologoEspecialidadController');
	//Route::get('centro-odontologo-especialidad/agendas','CentroOdontologoEspecialidadController@generarAgendas');
	//Route::get('centro-odontologo-especialidad/turnos','CentroOdontologoEspecialidadController@generarTurnos');
	Route::get('centro-odontologo-especialidad/{id}/agendas','CentroOdontologoEspecialidadController@agendas');
	Route::get('centro-odontologo-especialidad/detalle','CentroOdontologoEspecialidadController@vista_detallada');
	Route::post('centro-odontologo-especialidad/buscar','CentroOdontologoEspecialidadController@postBuscar');
	Route::resource('centro-odontologo-especialidad', 'CentroOdontologoEspecialidadController');

	Route::get('agenda/{id}/turnos','AgendaController@vistaTurnos');
	Route::post('agenda/buscar','AgendaController@postBuscar');
	Route::resource('agenda', 'AgendaController');

	Route::resource('usuario', 'UserController');
	
	Route::post('turno/{id}/liberar','TurnoController@liberar');
	Route::resource('turno', 'TurnoController');
	
	Route::get('esquema/{modelo}', 'HerramientasController@getEsquema');
});

Route::get('/api',function()
{
    return View::make('hello');
});


