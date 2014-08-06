<?php

class PacientePrepagaController extends MaestroController {

	function __construct(){
		$this->classname= 'PacientePrepaga';
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

	public function vista_detallada($paciente_id){
	$listado = $this->modelo->vistaDetallada($paciente_id);
	    return Response::json(array(
		'error' => false,
		'listado' => $listado),
		200
	    );

	}

	public function tomar_turno($paciente_prepaga_id){
		$params = Input::all();
		unset($params['apikey']);
		$turno_id = $params["turno_id"];
		$tipo = (isset($params["tipo"]) && !empty($params["tipo"]))?$params["tipo"]:"T";
		$user_id = Auth::user()->id;
		$paciente_prepaga = PacientePrepaga::findOrFail($paciente_prepaga_id);
		$turnos = explode(",",$turno_id);
		
		//si son muchos turnos
		if (count($turnos) > 1){
			$objTurnos = Turno::whereIn('id',$turnos)->where('estado','L')->get();
			if (count($objTurnos) == count($turnos)){
				$affectedRows = Turno::whereIn('id',$turnos)->where('estado','L')->update(array('estado' => 'A','paciente_prepaga_id'=>$paciente_prepaga->id, 'user_id'=>$user_id));
				if ($affectedRows == count($turnos)){
				foreach($objTurnos as $cadaTurno)	{
					$this->eventoAuditar($cadaTurno);
				}
				  	$turno = Turno::findOrFail($turnos[0]);
					return Response::json(array(
					'error'=>false,
					'listado'=>array($turno->find($turno->id)->toArray())),
					200);
				} else {
					return Response::json(array(
					'error'=>true,
					'mensaje' => 'No se pudieron asignar los turnos',
					'envio'=>$params,
					),200);
	
				}
				
			} else {
			    return Response::json(array(
				'error' => true,
				'mensaje' => "alguno de los turnos está tomado"),
				200
			    );
			}
		} else {
			//es un solo turno
			$turno = Turno::findorFail($turno_id);
			//chequea entreturno
			if($tipo == 'E'){
				$otros_entreturnos = Turno::where('padre','=',$turno->id)->get();
				$new_turno = new Turno();			
				$new_turno->fill($turno->toArray());
				$new_turno->id = null;
				$new_turno->padre = $turno->id;
				$turno = $new_turno;
				$turno->tipo_turno = 'E';
				$desde = strtotime(substr($turno->hora_desde,0,2).":".substr($turno->hora_desde,-2));
				$hasta = strtotime(substr($turno->hora_hasta,0,2).":".substr($turno->hora_hasta,-2));
				if (count($otros_entreturnos)==0){
					$n_desde = $desde + (($hasta - $desde)/2);
					$turno->hora_desde = date('Hi',$n_desde);
				} else {
					$intervalo = ($hasta -$desde) / (2 + count($otros_entreturnos));
					$n_desde = $desde + $intervalo;
					foreach ($otros_entreturnos as $entreturno){
						$entreturno->hora_desde = date('Hi',$n_desde);
						$entreturno->save();
						$n_desde += $intervalo; 
					}
					$turno->hora_desde =date('Hi',$n_desde);
				}
				$turno->estado = 'L';
	
			}
	
			//falta verificar turno bloqueado x mismo usuario
			if($turno->estado == 'L'){
				$turno->estado = 'A';
				$turno->paciente_prepaga_id = $paciente_prepaga->id;
				$turno->user_id = $user_id;
				if ($turno->save()){
				   $this->eventoAuditar($turno);
					return Response::json(array(
					'error'=>false,
					'listado'=>array($turno->find($turno->id)->toArray())),
					200);
				} else {
					return Response::json(array(
					'error'=>true,
					'mensaje' => HerramientasController::getErrores($turno->validator),
					'envio'=>$params,
					),200);
	
				}
			} else {
			    return Response::json(array(
				'error' => true,
				'mensaje' => "turno tomado"),
				200
			    );
			}
			
		}
	}
}
