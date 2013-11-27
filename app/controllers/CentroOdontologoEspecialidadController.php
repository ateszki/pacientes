<?php

class CentroOdontologoEspecialidadController extends MaestroController {

	function __construct(){
		$this->classname= 'CentroOdontologoEspecialidad';
		$this->modelo = new $this->classname();
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){
		return parent::index();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return parent::store();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return parent::show($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return parent::update($id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return parent::destroy($id);
	}

	public function agendas($id){
		
		$agendas = CentroOdontologoEspecialidad::find($id)->agendas()->get();
return Response::json(array(
                'error' => false,
                'listado' => $agendas->toArray()),
                200
            );
	

	}

	public function vista_detallada(){
	$listado = $this->modelo->vistaDetalladaOdontologosAlta();
	    return Response::json(array(
		'error' => false,
		'listado' => $listado),
		200
	    );

	}
	public function generarAgendas(){
		$errores = array();
		$coes = CentroOdontologoEspecialidad::where('habilitado','=',1)->get();
		if (count($coes)==0){
			return Response::json(array(
			'error' => true,
			'mensaje' => "No hay agendas para generar"),
			200
		    );
		}	
		foreach ($coes as $coe){
			$fecha_ini = date('Y-m-d');	
			$especialidad = $coe->especialidad;
			$odontologo = $coe->odontologo;
			$centro = $coe->centro;
			$lapso = $especialidad->lapso;
			$fecha_fin = date("Y-m-d",strtotime("+".$lapso." days", strtotime($fecha_ini)));
			while (strtotime($fecha_ini) <= strtotime($fecha_fin)) {
				if ($coe->existeAgenda($fecha_ini)){
					$fecha_ini =  date ("Y-m-d", strtotime("+1 day", strtotime($fecha_ini)));
					continue;
				} else {	
					$agenda = new Agenda;
					$agenda->centro_odontologo_especialidad_id = $coe->id;
					$agenda->fecha = $fecha_ini;
					$agenda->odontologo_efector_id = $odontologo->id;
					$agenda->habilitado_turnos = 1;
					if ($agenda->isValid()){
						$agenda->save();
						$horario_desde = date('H:i',strtotime(substr_replace($coe->horario_desde,':',2,0)));
						$horario_hasta = date('H:i',strtotime(substr_replace($coe->horario_hasta,':',2,0)));
						$duracion = $coe->duracion_turno;
						$hora = $horario_desde;
						$hora_hasta = date('H:i',strtotime("+".$duracion." minutes", strtotime($hora)));
						while (strtotime($hora) < strtotime($horario_hasta)){
							$turno = new Turno;
							$turno->agenda_id = $agenda->id;
							$turno->hora_desde = str_replace(":","",$hora);
							$turno->hora_hasta = str_replace(":","",$hora_hasta);
							$turno->tipo_turno = 'T';// turno
							$turno->estado = 'L';// libre
							if ($turno->isValid()){
								$turno->save();
							}else{
								$errores[] = array("agenda"=>$agenda->id,"errrores"=>HerramientasController::getErrores($turno->validator));
							}
							$hora = $hora_hasta;
							$hora_hasta = date('H:i',strtotime("+".$duracion." minutes", strtotime($hora)));

						}					        
					} else {
						$errores[] = array('centro_odontologo_especialidad'=>$coe->id,'errores'=>HerramientasController::getErrores($agenda->validator));
					}
					$fecha_ini =  date ("Y-m-d", strtotime("+1 day", strtotime($fecha_ini)));
				}
			}
				
		}
		if(count($errores)){
			return Response::json(array(
			'error' => true,
			'mensaje' => "Se produjeron errores al generar las agendas",
			'errores' => $errores,),
			200
		    );
		} else {
			return Response::json(array(
			'error' => false,
			'mensaje' => "Se generaron las agendas"),
			200
		    );
		}
	}
}
