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
		$modelo = $this->modelo->find($id);
		$data = array(
		"estado" => 'L',
		"paciente_prepaga_id" => null,
		"motivo_turno_id" => null,
		"piezas" => null,
		"derivado_por" => null,
		"observaciones" => null,
		"user_id" => Auth::user()->id,
		);
		$modelo->fill($data);
		if ($modelo->save() !== false){

			return Response::json(array(
			'error'=>false,
			'modelo'=>$modelo->toArray()),
			200);
		}else {
			
			 return Response::json(array(
                        'error'=>true,
                        'mensaje' => HerramientasController::getErrores($modelo->validator),
                        'envio'=>$modelo->toArray(),
                        ),200);
		}
	}
}
