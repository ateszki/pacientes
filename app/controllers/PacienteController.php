<?php

class PacienteController extends MaestroController {

	function __construct(){
		$this->classname= 'Paciente';
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

	public function prepagas($id){
	try{	
		$prepagas = Paciente::findOrFail($id)->prepagas()->get();
		return Response::json(array(
                'error' => false,
                'listado' => $prepagas->toArray()),
                200
            );
	}catch (Exception $e){
		return Response::json(array('error'=>true,'mensaje'=>$e->getMessage()?:'No se encuentra el recurso:'.$id),200);
	}
	

	}

public function observaciones_detalladas($id){
	$paciente = Paciente::findOrFail($id);
	$observaciones = $paciente->observaciones()->with('user')->get();
	$detallado = array();
	foreach($observaciones as $obs){
		$detallado[] = array(
				"id" => $obs->id,
				"observacion" => $obs->observacion,
				"fecha_hora" => date('d-m-Y H:i',strtotime($obs->created_at)),
				"user_id" => $obs->user_id,
				"usuario" => $obs->user->nombre,
		);
	}
		return Response::json(array(
                'error' => false,
                'listado' => $detallado),
                200
		    );
}
}
