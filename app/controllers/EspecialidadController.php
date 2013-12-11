<?php

class EspecialidadController extends MaestroController {

	function __construct(){
		$this->classname= 'Especialidad';
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

public function turnos_libres($especialidad_id){

	$parametros = Input::all();
	unset($parametros['apikey']);
if (!isset($parametros["param"]) || empty($parametros["param"])){
	$param = array("odontologos"=>'',"centros"=>'',"turnos"=>'',"dias"=>'');
} else {
	$param = $parametros["param"];
	$param = json_decode($param,true);
}
//var_dump($param);
//die();
	$listado = Turno::turnos_libres($especialidad_id,$param);
	    return Response::json(array(
		'error' => false,
		'listado' => $listado),
		200
	    );
	
}

}
