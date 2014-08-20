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
	App::abort(401, 'Ingreso no autorizado.');
    }
});

Route::filter('usuarioauth', function()
{
	$u = User::where("session_key","=",Input::get("session_key"))->where("session_expira",">=",date("Y-m-d H:i:s"))->get();
	if (count($u)==0)
	    {
		App::abort(401, 'Ud no está autenticado.');
	    }
	Auth::loginUsingId($u[0]->id);
});

Route::group(array('before' => 'apiauth'),function()
{
	Route::post('usuario/login','UserController@validar');	
});
Route::group(array('before' => 'apiauth|usuarioauth'), function()
{
	Route::post('consultorio/buscar','ConsultorioController@postBuscar');
	Route::resource('consultorio', 'ConsultorioController');
	
	Route::get('odontologo/{id}/ausencia-odontologo','OdontologoController@ver_ausencias');
	Route::get('odontologo/{id}/centros-especialidades','OdontologoController@centros_especialidades');
	Route::post('odontologo/buscar','OdontologoController@postBuscar');
	Route::resource('odontologo', 'OdontologoController');

	Route::resource('tipo-observaciones-pacientes', 'TipoObservacionesController');


	Route::post('ausencia-odontologo/buscar','AusenciaOdontologoController@postBuscar');
	Route::resource('ausencia-odontologo', 'AusenciaOdontologoController');

	Route::get('paciente/{paciente_id}/observaciones','PacienteController@observaciones_detalladas');
	Route::get('paciente/{paciente_id}/prepaga','PacientePrepagaController@vista_detallada');
	Route::post('paciente/buscar','PacienteController@postBuscar');
	Route::resource('paciente', 'PacienteController');

	Route::get('prepaga/{id}/pacientes','PrepagaController@pacientes');
	Route::post('prepaga/buscar','PrepagaController@postBuscar');
	Route::resource('prepaga', 'PrepagaController');

	Route::post('paciente-prepaga/{paciente_prepaga_id}/tomar-turno','PacientePrepagaController@tomar_turno');
	Route::post('paciente-prepaga/buscar','PacientePrepagaController@postBuscar');
	Route::resource('paciente-prepaga','PacientePrepagaController');

	Route::post('paciente-observacion/buscar','PacienteObservacionController@postBuscar');
	Route::resource('paciente-observacion', 'PacienteObservacionController');
	
	Route::post('centro/buscar','CentroController@postBuscar');
	Route::resource('centro', 'CentroController');
	
	Route::get('especialidad/{especialidad_id}/motivos-turnos','EspecialidadMotivoTurnoController@vista_detallada');
	Route::get('especialidad/{especialidad_id}/turnos-libres','EspecialidadController@turnos_libres');
	Route::post('especialidad/buscar','EspecialidadController@postBuscar');
	Route::resource('especialidad', 'EspecialidadController');

	Route::resource('especialidad-motivo-turno', 'EspecialidadMotivoTurnoController');

	
	Route::get('centro-odontologo-especialidad/{id}/agendas','CentroOdontologoEspecialidadController@agendas');
	Route::get('centro-odontologo-especialidad/{id}/crear-agenda/{fecha}','CentroOdontologoEspecialidadController@generarAgenda');
	Route::get('centro-odontologo-especialidad/turnos','CentroOdontologoEspecialidadController@vistaTurnos');
	Route::get('centro-odontologo-especialidad/observaciones','CentroOdontologoEspecialidadController@observacionesAgenda');
	Route::get('centro-odontologo-especialidad/agendas','CentroOdontologoEspecialidadController@agendas_multi_dias');
	Route::get('centro-odontologo-especialidad/detalle','CentroOdontologoEspecialidadController@vista_detallada');
	Route::post('centro-odontologo-especialidad/buscar','CentroOdontologoEspecialidadController@postBuscar');
	Route::resource('centro-odontologo-especialidad', 'CentroOdontologoEspecialidadController');

	Route::post('agenda/{id}/habilitar','AgendaController@habilitarTurnos');
	Route::post('agenda/{id}/deshabilitar','AgendaController@deshabilitarTurnos');
	Route::post('agenda/{id}/efector/{efector_id}','AgendaController@cambiaEfector');
	Route::get('agenda/{id}/turnos','AgendaController@vistaTurnos');
	Route::post('agenda/buscar','AgendaController@postBuscar');
	Route::resource('agenda', 'AgendaController');

	Route::resource('usuario', 'UserController');
	
	Route::post('pais/buscar','PaisController@postBuscar');
	Route::resource('pais', 'PaisController');

	Route::post('provincia/buscar','ProvinciaController@postBuscar');
	Route::resource('provincia', 'ProvinciaController');

	Route::post('iva/buscar','IvaController@postBuscar');
	Route::resource('iva', 'IvaController');

	Route::post('tabla/buscar','TablaController@postBuscar');
	Route::resource('tabla', 'TablaController');

	Route::resource('motivo-turno', 'MotivoTurnoController');

	Route::post('turno/{id}/liberar','TurnoController@liberar');
	Route::resource('turno', 'TurnoController');
	
// cuentas corrientes
	Route::post('factura','CtacteController@crear');	

// generales
	Route::get('esquema/{modelo}', 'HerramientasController@getEsquema');
});



