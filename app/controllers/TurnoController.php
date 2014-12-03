<?php

class TurnoController extends MaestroController {

	function __construct(){
		$this->classname= 'Turno';
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
	public function liberar($id){
		try{
			$turnos = explode(",",$id);
			
			//si son muchos turnos
			if (count($turnos) > 1){
				$affectedRows = Turno::whereIn('id',$turnos)->where('estado','A')->update(array('estado' => 'L','paciente_prepaga_id'=>NULL, 'user_id'=>Auth::user()->id,"motivo_turno_id"=>NULL,'piezas'=>NULL,'derivado_por'=>NULL,'observaciones'=>NULL,'fuera_de_agenda'=>NULL));
				if ($affectedRows == count($turnos)){
					$objTurnos = Turno::whereIn('id',$turnos)->where('estado','L')->get();	
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
					'mensaje' => 'No se pudieron desasignar los turnos',
					'envio'=>$turnos,
					),200);
	
				}
				
			} else {
				$modelo = $this->modelo->find($id);
				//elimina si es entreturno
				if($modelo->tipo_turno == 'E'){
					return $this->destroy($id);
				}
				$data = array(
				"estado" => 'L',
				"paciente_prepaga_id" => null,
				"motivo_turno_id" => null,
				"piezas" => null,
				"derivado_por" => null,
				"observaciones" => null,
				"fuera_de_agenda" => null,
				"user_id" => Auth::user()->id,
				);
				$modelo->fill($data);
				if ($modelo->save() !== false){
					$this->eventoAuditar($modelo);
					return Response::json(array(
					'error'=>false,
					'listado'=>array($modelo->toArray()),),
					200);
				}else {
					
					 return Response::json(array(
					'error'=>true,
					'mensaje' => HerramientasController::getErrores($modelo->validator),
					'listado'=>array($modelo->toArray()),
					),200);
				}
			}
		} catch(Exception $e){
			return Response::json(array(
			'error' => true,
			'mensaje' => $e->getMessage()),
			200
			    );
		}
	}

	public function traza($id){
		try {
			$eventos = Evento::where('modelo_id','=',$id)->where('modelo','=',$this->classname)->orderBy('created_at')->get();
			return Response::json(array(
			'error'=>false,
			'listado'=>$eventos),
			200);
		} catch(Exception $e){
			return Response::json(array(
			'error' => true,
			'mensaje' => $e->getMessage()),
			200
			    );
		}
	}
	public function presente($id){
		try{
			$modelo = $this->modelo->findOrFail($id);
			$modelo->presente = ($modelo->presente== 1)?0:1;
			if ($modelo->save() !== false){
				$this->eventoAuditar($modelo);
				return Response::json(array(
				'error'=>false,
				'listado'=>array($modelo->toArray())),
				200);
			}else {
				return Response::json(array(
				'error'=>true,
				'mensaje' => HerramientasController::getErrores($modelo->validator),
				'listado'=>$modelo->toArray(),
				),200);
			}	

		} catch(Exception $e){
			return Response::json(array(
			'error' => true,
			'mensaje' => $e->getMessage()),
			200
			    );
		}
	}

	public function tratamientos($id){
		try{
			$modelo = $this->modelo->findOrFail($id);
			$tratamientos = $modelo->tratamientos()->get();			
			$this->eventoAuditar($modelo);
			return Response::json(array(
			'error'=>false,
			'listado'=>$tratamientos),
			200);

		} catch(Exception $e){
			return Response::json(array(
			'error' => true,
			'mensaje' => $e->getMessage()),
			200
			    );
		}
	}
}
