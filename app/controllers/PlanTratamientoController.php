<?php

class PlanTratamientoController extends MaestroController {

	function __construct(){
		$this->classname= 'PlanTratamiento';
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

	public function derivaciones($plan_tratamiento_id){
		try{
			$pt = PlanTratamiento::findOrFail($plan_tratamiento_id);
			$derivaciones = $pt->derivaciones()->orderBy('id')->get();
			return Response::json(array(
				'error'=>false,
				'listado'=>$derivaciones),
				200);
		} catch(\Exception $e){
			return Response::json(array(
			'error' => true,
			'mensaje' => $e->getMessage()),
			200
			);
		}
	}
	public function seguimiento($plan_tratamiento_id){
		try{
			$pt = PlanTratamiento::findOrFail($plan_tratamiento_id);
			$seguimiento = $pt->seguimiento()->get();
			return Response::json(array(
				'error'=>false,
				'listado'=>$seguimiento),
				200);
		} catch(\Exception $e){
			return Response::json(array(
			'error' => true,
			'mensaje' => $e->getMessage()),
			200
			);
		}
	}
}
