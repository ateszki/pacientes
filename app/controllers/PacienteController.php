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

	public function setPrepaga($id,$prepaga_id){
		try {
		Paciente::find($id)->prepagas()->attach($prepaga_id);
		return Response::json(array('error'=>false),200);
		} catch (Exception $e){
		return Response::json(array('error'=>true,'mensaje'=>$e->getMessage()),200);
		}
	}

	public function unsetPrepaga($id,$prepaga_id){
		try {
		Paciente::find($id)->prepagas()->detach($prepaga_id);
		return Response::json(array('error'=>false),200);
		} catch (Exception $e){
		return Response::json(array('error'=>true,'mensaje'=>$e->getMessage()),200);
		}
	}
}
