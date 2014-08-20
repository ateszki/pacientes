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
		$coe = CentroOdontologoEspecialidad::find($id);
		$dias = $coe->especialidad->lapso;
		$params = Input::all();
		$desde = (isset($params["desde"])&& !empty($params["desde"]))?$params["desde"]:date("Y-m-d");	
		$hasta = (isset($params["hasta"])&& !empty($params["hasta"]))?$params["hasta"]:date("Y-m-d",strtotime($desde." +".$dias." days"));	
		$agendas = $coe->agendas()->whereBetween('fecha',array($desde,$hasta))->with(array('turnos'=>function($query){$query->where('estado','=','L');}))->get();
		/* cuento turnos libres */
		$agendas_array = $agendas->toArray();
		function turnoslibres($a){
			$a["turnos"] = (count($a["turnos"]))?true:false;;
			return$a;
		}
		$agendas_array1 = array_map('turnoslibres',$agendas_array);

		return Response::json(array(
                'error' => false,
                'listado' => $agendas_array1),
                200
            );
	

	}

	public function agendas_multi_dias(){
		$params = Input::all();
		$especialidad = Especialidad::findOrFail($params['especialidad_id']);
		$dias = $especialidad->lapso;
		$desde = (isset($params["desde"])&& !empty($params["desde"]))?$params["desde"]:date("Y-m-d");	
		$hasta = (isset($params["hasta"])&& !empty($params["hasta"]))?$params["hasta"]:date("Y-m-d",strtotime($desde." +".$dias." days"));	
		$coes = CentroOdontologoEspecialidad::where('odontologo_id',$params['odontologo_id'])
				->where('centro_id',$params['centro_id'])
				->where('especialidad_id',$params['especialidad_id'])->get();

		$agendas_array = array();
		foreach ($coes as $coe){
			$aa = $agendas_array; 
			$agendas = $coe->agendas()->whereBetween('fecha',array($desde,$hasta))->with(array('turnos'=>function($query){$query->where('estado','=','L');}))->get();
			$agendas_array = array_merge($aa,$agendas->toArray());
		}		
/* cuento turnos libres */
		function turnoslibres($a){
			$a["turnos"] = (count($a["turnos"]))?true:false;;
			return$a;
		}
		$agendas_array1 = array_map('turnoslibres',$agendas_array);

		return Response::json(array(
                'error' => false,
                'listado' => $agendas_array1),
                200
            );
	

	}


	public function observacionesAgenda(){
		//$a = Route::currentRouteAction();
		//$a = Route::getRoutes();
		//dd($a);
		$params = Input::all();
		$dow = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
		$coes = CentroOdontologoEspecialidad::where('odontologo_id',$params['odontologo_id'])
				->where('centro_id',$params['centro_id'])
				->where('especialidad_id',$params['especialidad_id'])
				->where('dia_semana',$dow[date('w',strtotime($params["fecha"]))] )
				->get();
		$observaciones = array();
		foreach ($coes as $coe){
			if(!empty($coe->observaciones)){
				$observaciones[] = array("observacion"=>$coe->observaciones);
			}
		}		
	    return Response::json(array(
		'error' => false,
		'listado' => $observaciones,
		),
		200
		    );

	}

	public function vistaTurnos(){
		$params = Input::all();
		$coes = CentroOdontologoEspecialidad::where('odontologo_id',$params['odontologo_id'])
				->where('centro_id',$params['centro_id'])
				->where('especialidad_id',$params['especialidad_id'])->get();
		$turnos = array();
		$observaciones = array();
		foreach ($coes as $coe){
			if(!empty($coe->observaciones)){
				$observaciones[] = $coe->observaciones;
			}
			$agendas = $coe->agendas()->where('habilitado_turnos','=',1)->where('fecha','=',$params["fecha"])->get();
			foreach ($agendas as $a){
				$ts = $a->vistaTurnos();
				$turnos = array_merge($turnos,$ts);	
			}
		}		
	    return Response::json(array(
		'error' => false,
		'listado' => $turnos,
		),
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
/*
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
*/
	public function generarAgendas(){
		$coes = CentroOdontologoEspecialidad::whereNotIn('especialidad_id',function($query){$query->select('id')->from('especialidades')->where('genera_agendas','=',0);})->where('habilitado','=',1)->get();
		if (count($coes)==0){
			return json_encode(array(
			'error' => true,
			'mensaje' => "No hay agendas para generar"));
		}	
		$errores = false;
		$agendas_general = 0;
		$dow = array('Domingo'=>0,'Lunes'=>1,'Martes'=>2,'Miercoles'=>3,'Jueves'=>4,'Viernes'=>5,'Sabado'=>6);
		foreach ($coes as $coe){
			$fecha_ini = date('Y-m-d');	
			$especialidad = $coe->especialidad;
			$odontologo = $coe->odontologo;
			$centro = $coe->centro;
			$lapso = $especialidad->lapso;
			$fecha_fin = date("Y-m-d",strtotime("+".$lapso." days", strtotime($fecha_ini)));
			$agendas = array();
			while (strtotime($fecha_ini) <= strtotime($fecha_fin)) {
				$f = new Feriado;
				
				if($f->esFeriado($fecha_ini)){
				//	echo "Feriado".$fecha_ini;
					$fecha_ini =  date ("Y-m-d", strtotime("+1 day", strtotime($fecha_ini)));
					continue;
				} elseif ($dow[$coe->dia_semana] != date('w',strtotime($fecha_ini))){
					$fecha_ini =  date ("Y-m-d", strtotime("+1 day", strtotime($fecha_ini)));
					continue;
				} elseif ($coe->existeAgenda($fecha_ini)){
					$fecha_ini =  date ("Y-m-d", strtotime("+1 day", strtotime($fecha_ini)));
					continue;
				//} elseif ($coe->odontologo()->existeAusencia($fecha_ini) > 0){
				} elseif ($odontologo->existeAusencia($fecha_ini) > 0){
					$fecha_ini =  date ("Y-m-d", strtotime("+1 day", strtotime($fecha_ini)));
					continue;
				} else {	
					$agenda = array();
					$agenda["centro_odontologo_especialidad_id"] = $coe->id;
					$agenda["fecha"] = $fecha_ini;
					$agenda["odontologo_efector_id"] = $odontologo->id;
					$agenda["habilitado_turnos"] = 1;
					$agenda["created_at"] = date("Y-m-d H:i:s");
					$agenda["updated_at"] = date("Y-m-d H:i:s");
					$agendas[] = $agenda; 
				}
				$fecha_ini =  date ("Y-m-d", strtotime("+1 day", strtotime($fecha_ini)));
			}
			$err_agenda = true;
			$agendas_general += count($agendas);
			if(count($agendas)){$err_agenda = Agenda::insert($agendas);}
			if(!$err_agenda){$errores = true;}	
		}
		if($agendas_general == 0){
			return json_encode(array(
			'error' => true,
			'mensaje' => "No hay agendas para generar"));
		}
		$t = $this->generarTurnos();
		if(!$t){$errores = true;}
		if($errores){
			return json_encode(array(
			'error' => true,
			'mensaje' => "Se produjeron errores al generar las agendas",
			));
		} else {
			return json_encode(array(
			'error' => false,
			'mensaje' => "Se generaron las agendas"));
		}
	}

	public function generarAgenda($id,$fecha){
		$errores = false;
		$agendas_general = 0;
		$dow = array('Domingo'=>0,'Lunes'=>1,'Martes'=>2,'Miercoles'=>3,'Jueves'=>4,'Viernes'=>5,'Sabado'=>6);
	    		$coe = $this->modelo->find($id);
			
			$fecha_ini = $fecha;	
			$especialidad = $coe->especialidad;
			$odontologo = $coe->odontologo;
			$centro = $coe->centro;
			$lapso = 1;
			$fecha_fin = date("Y-m-d",strtotime("+".$lapso." days", strtotime($fecha_ini)));
			$agendas = array();

		if ($coe->habilitado != 1){
			return json_encode(array(
			'error' => true,
			'listado' => "El centro-odontologo-especialidad no está habilitado"));

		}
			while (strtotime($fecha_ini) <= strtotime($fecha_fin)) {
				$f = new Feriado;
				if ($f->esFeriado($fecha_ini)){
				//	echo "Feriado".$fecha_ini;
					$fecha_ini =  date ("Y-m-d", strtotime("+1 day", strtotime($fecha_ini)));
					continue;
				} elseif ($dow[$coe->dia_semana] != date('w',strtotime($fecha_ini))){
					$fecha_ini =  date ("Y-m-d", strtotime("+1 day", strtotime($fecha_ini)));
					continue;
				} elseif ($coe->existeAgenda($fecha_ini)){
					$fecha_ini =  date ("Y-m-d", strtotime("+1 day", strtotime($fecha_ini)));
					continue;
				//} elseif ($coe->odontologo()->existeAusencia($fecha_ini) > 0){
				} elseif ($odontologo->existeAusencia($fecha_ini) > 0){
					$fecha_ini =  date ("Y-m-d", strtotime("+1 day", strtotime($fecha_ini)));
					continue;
				} else {	
					$agenda = new Agenda;
					$agenda->centro_odontologo_especialidad_id = $coe->id;
					$agenda->fecha = $fecha_ini;
					$agenda->odontologo_efector_id = $odontologo->id;
					$agenda->habilitado_turnos = 1;
					$agenda->created_at = date("Y-m-d H:i:s");
					$agenda->updated_at = date("Y-m-d H:i:s");
					$agendas[] = $agenda; 
				}
				$fecha_ini =  date ("Y-m-d", strtotime("+1 day", strtotime($fecha_ini)));
			}
			$err_agenda = true;
			$agendas_general += count($agendas);
			if(count($agendas)){$err_agenda = $agenda->save();}
			if(!$err_agenda){$errores = true;}	
		if($agendas_general == 0){
			return json_encode(array(
			'error' => true,
			'listado' => "No hay agendas para generar"));
		}
		$t = $this->generarTurnos($agenda->id);
		if(!$t){$errores = true;}
		if($errores){
			return json_encode(array(
			'error' => true,
			'listado' => "Se produjeron errores al generar las agendas",
			));
		} else {
			return json_encode(array(
			'error' => false,
			'listado' => "Se generaron las agendas"));
		}
	}
	public function generarTurnos($agenda_id = NULL){
		$errores = true;
		if (empty($agenda_id)){
			$agendas = Agenda::whereNotIn('id',function($query){$query->select('agenda_id')->from('turnos');})->where('habilitado_turnos','=',1)->get();
		} else {
			$agendas = Agenda::where('id',$agenda_id)->get();
		}	
		foreach ($agendas as $agenda){
			$coe = $agenda->centroOdontologoEspecialidad;
			$horario_desde = date('H:i',strtotime(substr_replace($coe->horario_desde,':',2,0)));
			$horario_hasta = date('H:i',strtotime(substr_replace($coe->horario_hasta,':',2,0)));
			$duracion = $coe->duracion_turno;
			$hora = $horario_desde;
			$hora_hasta = date('H:i',strtotime("+".$duracion." minutes", strtotime($hora)));
			$turnos = array();
			while (strtotime($hora) < strtotime($horario_hasta)){
				$turno = array();
				$turno["agenda_id"] = $agenda->id;
				$turno["hora_desde"] = str_replace(":","",$hora);
				$turno["hora_hasta"] = str_replace(":","",$hora_hasta);
				$turno["tipo_turno"] = 'T';// turno
				$turno["estado"] = 'L';// libre
				$turno["created_at"] = date("Y-m-d H:i:s");
				$turno["updated_at"] = date("Y-m-d H:i:s");
				$turnos[] = $turno;
				$hora = $hora_hasta;
				$hora_hasta = date('H:i',strtotime("+".$duracion." minutes", strtotime($hora)));

			}		
			$e = Turno::insert($turnos);
			if(!$e)	{$errores = false;}		        
		}	
		return  $errores;
	}
}
