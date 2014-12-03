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
	Route::post('user/login','UserController@validar');	
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

	Route::get('paciente/{paciente_id}/turnos','PacienteController@turnos');
	Route::get('paciente/{paciente_id}/tratamientos','PacienteController@tratamientos');
	Route::get('paciente/{paciente_id}/fichados-vista','PacienteController@fichadosVista');
	Route::get('paciente/{paciente_id}/fichados-items/{pieza_dental_id}','PacienteController@fichadosItems');
	Route::get('paciente/{paciente_id}/fichados','PacienteController@fichados');
	Route::get('paciente/{paciente_id}/ordenes-trabajo','OrdenTrabajoController@ordenesTrabajoPaciente');
	Route::get('paciente/{paciente_id}/presupuestos','PresupuestoController@presupuestosPaciente');
	Route::get('paciente/{paciente_id}/presupuestos-vista','PresupuestoController@presupuestosPacienteVista');
	Route::get('paciente/{paciente_id}/ctacte','CtacteController@movimientosPaciente');
	Route::get('paciente/{paciente_id}/observaciones','PacienteController@observaciones_detalladas');
	Route::get('paciente/{paciente_id}/prepaga','PacientePrepagaController@vista_detallada');
	Route::get('paciente/{paciente_id}/datos-relacionados','PacienteController@datosRelacionados');
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

	Route::post('user/validar','UserController@validarSimple');	
	Route::post('user/buscar','UserController@postBuscar');
	Route::get('user/{id}/groups','UserController@grupos');
	Route::post('user/{id}/groups/modificar', 'UserController@setGroups');
	Route::get('user/{id}/roles','UserController@roles');
	Route::post('user/{id}/set-password','UserController@setPassword');
	Route::resource('user', 'UserController');
	Route::post('group/buscar','GroupController@postBuscar');
	Route::get('group/{id}/users', 'GroupController@users');
	Route::post('group/{id}/users/modificar', 'GroupController@setUsers');
	Route::get('group/{id}/roles', 'GroupController@roles');
	Route::post('group/{id}/roles/modificar', 'GroupController@setRoles');
	Route::resource('group', 'GroupController');
	Route::post('role/buscar','RoleController@postBuscar');
	Route::resource('role', 'RoleController');
	
	Route::post('pais/buscar','PaisController@postBuscar');
	Route::resource('pais', 'PaisController');

	Route::post('provincia/buscar','ProvinciaController@postBuscar');
	Route::resource('provincia', 'ProvinciaController');

	Route::post('iva/buscar','IvaController@postBuscar');
	Route::resource('iva', 'IvaController');

	Route::post('tabla/buscar','TablaController@postBuscar');
	Route::resource('tabla', 'TablaController');

	Route::resource('motivo-turno', 'MotivoTurnoController');

	Route::post('turno/{id}/tratamientos','TurnoController@tratamientos');
	Route::post('turno/{id}/presente','TurnoController@presente');
	Route::post('turno/{id}/liberar','TurnoController@liberar');
	Route::get('turno/{id}/traza','TurnoController@traza');
	Route::resource('turno', 'TurnoController');
	
// cuentas corrientes
	Route::post('factura/crear','CtacteController@crear');	
	Route::get('factura/{id}','CtacteController@traerMovimiento');	
	Route::get('factura/{id}/items','CtacteController@traerItems');	
	Route::get('factura/{id}/pagos','CtacteController@traerPagos');	
	Route::resource('factura', 'CtacteController');

	Route::post('presupuesto/buscar','PresupuestoController@postBuscar');
	Route::post('presupuesto/crear','PresupuestoController@crear');	
	Route::post('presupuesto/{id}/restaurar','PresupuestoController@restaurar');	
	Route::post('presupuesto/{id}/aprobar','PresupuestoController@aprobar');	
	//Route::put('presupuesto/{id}/actualizar','PresupuestoController@actualizar');	
	//Route::delete('presupuesto/{id}/eliminar','PresupuestoController@eliminar');	
	Route::get('presupuesto/{id}/items','PresupuestoController@traerItems');	
	Route::get('presupuesto/{id}','PresupuestoController@traerPresupuesto');	
	Route::resource('presupuesto', 'PresupuestoController');

	Route::post('nomenclador/buscar','NomencladorController@postBuscar');
	Route::resource('nomenclador', 'NomencladorController');
	
	Route::post('tratamiento/buscar','TratamientoController@postBuscar');
	Route::resource('tratamiento', 'TratamientoController');

	Route::post('planes-cobertura/buscar','PlanesCoberturaController@postBuscar');
	Route::get('planes-cobertura/{id}/especialidades','PlanesCoberturaController@vista_especialidades');
	Route::resource('planes-cobertura', 'PlanesCoberturaController');

	Route::post('plan-cobertura-especialidad/buscar','PlanCoberturaEspecialidadController@postBuscar');
	Route::resource('plan-cobertura-especialidad', 'PlanCoberturaEspecialidadController');

	Route::post('plan-prepaga/buscar','PlanPrepagaController@postBuscar');
	Route::get('plan-prepaga/{id}/precios-nomenclador','PlanPrepagaController@nomencladorLista');
	Route::resource('plan-prepaga', 'PlanPrepagaController');

	Route::post('listas-precios/buscar','ListaPreciosController@postBuscar');
	Route::get('listas-precios/{lista_id}/precios-nomenclador','ListaPreciosNomencladorController@nomencladorLista');
	Route::resource('listas-precios', 'ListaPreciosController');

	Route::post('listas-precios-nomenclador/buscar','ListaPreciosNomencladorController@postBuscar');
	Route::resource('listas-precios-nomenclador', 'ListaPreciosNomencladorController');

	Route::post('listas-precios-laboratorio/buscar','ListaPreciosLaboratorioController@postBuscar');
	Route::resource('listas-precios-laboratorio', 'ListaPreciosLaboratorioController');

	Route::post('piezas-dentales/buscar','PiezaDentalController@postBuscar');
	Route::resource('piezas-dentales', 'PiezaDentalController');

	Route::post('grupos-dentales/buscar','GrupoDentalController@postBuscar');
	Route::resource('grupos-dentales', 'GrupoDentalController');

	Route::post('grupos-dentales-piezas-dentales/buscar','GrupsDentalPiezaDentalController@postBuscar');
	Route::resource('grupos-dentales-piezas-dentales', 'GrupoDentalPiezaDentalController');

// ordenes de trabajo
	Route::get('laboratorio/{id}/precios','LaboratorioController@precios');
	Route::post('laboratorio/buscar','LaboratorioController@postBuscar');
	Route::resource('laboratorio', 'LaboratorioController');

	Route::post('nomenclador-paso/buscar','NomencladorPasoController@postBuscar');
	Route::resource('nomenclador-paso', 'NomencladorPasoController');

	Route::get('orden-trabajo/{id}/items','OrdenTrabajoController@traerItems');	
	Route::get('orden-trabajo/{id}','OrdenTrabajoController@traerOrdenTrabajo');	
	Route::post('orden-trabajo/recibir-remito','OrdenTrabajoController@recibirRemito');
	Route::post('orden-trabajo/cancelar-recepcion','OrdenTrabajoController@cancelarRecepcion');
	Route::post('orden-trabajo/buscar','OrdenTrabajoController@postBuscar');
	Route::resource('orden-trabajo', 'OrdenTrabajoController');

	Route::post('referencia-fichado/buscar','ReferenciaFichadoController@postBuscar');
	Route::resource('referencia-fichado', 'ReferenciaFichadoController');

	Route::get('fichado/{id}/items','FichadoController@traerItems');	
	Route::get('fichado/{id}','FichadoController@traerFichado');	
	Route::post('fichado/buscar','FichadoController@postBuscar');
	Route::resource('fichado', 'FichadoController');

// caja
	Route::post('caja/buscar','CajaController@postBuscar');
	Route::resource('caja', 'CajaController');

	Route::post('tipo-mov-caja/buscar','TipoMovCajaController@postBuscar');
	Route::resource('tipo-mov-caja', 'TipoMovCajaController');

	Route::post('medio-pago-caja/buscar','MedioPagoCajaController@postBuscar');
	Route::resource('medio-pago-caja', 'MedioPagoCajaController');

	Route::get('movimiento-caja/informe','MovimientoCajaController@informe');
	Route::post('movimiento-caja/buscar','MovimientoCajaController@postBuscar');
	Route::resource('movimiento-caja', 'MovimientoCajaController');

// generales
	Route::get('fecha-hora', 'HerramientasController@getFechaHora');
	Route::get('esquema/{modelo}', 'HerramientasController@getEsquema');
	Route::get('iniciar-formulario','MaestroController@iniciarFormulario');
});



