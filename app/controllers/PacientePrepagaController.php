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

		$paciente_prepaga = PacientePrepaga::findOrFail($paciente_prepaga_id);
		$turno = Turno::findOrFail($turno_id);
		
		//falta verificar turno bloqueado x mismo usuario
		if($turno->estado == 'L'){
			$turno->estado = 'A';
			$turno->paciente_prepaga_id = $paciente_prepaga->id;
			if ($turno->save()){
			   return Response::json(array(
				'error'=>false,
				'envio'=>array($turno->find($turno->id)->toArray())),
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
