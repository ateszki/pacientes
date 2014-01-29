<?php

class AgendaController extends MaestroController {

	function __construct(){
		$this->classname= 'Agenda';
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
	
	public function vistaTurnos($id){
	$turnos = Agenda::find($id)->vistaTurnos();
	    return Response::json(array(
		'error' => false,
		'listado' => $turnos),
		200
	    );
	}

	public function cambiaEfector($id,$efector_id){
		try {
			$a = Agenda::findOrFail($id);
			$a->odontologo_efector_id = $efector_id;
			if ($a->save()){
				    return Response::json(array(
					'error' => false,
					'listado' => $a->toArray()),
					200
				    );
			} else {
				    return Response::json(array(
					'error' => true,
						'mensaje' => HerramientasController::getErrores($a->validator),
						'listado'=>$a->toArray(),
						),200);
			}
			} catch (Exception $e){
						return Response::json(array(
						'error' => true,
						'mensaje' => $e->getMessage()),
						200
					    );
			}
	}

	public function deshabilitarTurnos($id){
		try {
			$a = Agenda::findOrFail($id);
			$a->habilitado_turnos = 0;
			if ($a->save()){
				    return Response::json(array(
					'error' => false,
					'listado' => $a->toArray()),
					200
				    );
			} else {
				    return Response::json(array(
					'error' => true,
						'mensaje' => HerramientasController::getErrores($a->validator),
						'listado'=>$a->toArray(),
						),200);
			}
			} catch (Exception $e){
						return Response::json(array(
						'error' => true,
						'mensaje' => $e->getMessage()),
						200
					    );
			}
	}

	public function habilitarTurnos($id){
		try {
			$a = Agenda::findOrFail($id);
			$a->habilitado_turnos = 1;
			if ($a->save()){
				    return Response::json(array(
					'error' => false,
					'listado' => $a->toArray()),
					200
				    );
			} else {
				    return Response::json(array(
					'error' => true,
						'mensaje' => HerramientasController::getErrores($a->validator),
						'listado'=>$a->toArray(),
						),200);
			}
			} catch (Exception $e){
						return Response::json(array(
						'error' => true,
						'mensaje' => $e->getMessage()),
						200
					    );
			}
	}
}
