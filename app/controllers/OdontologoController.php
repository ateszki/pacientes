<?php

class OdontologoController extends \BaseController {

	var $esquema;
	public function __construct(){
	//	$this->filter
		//$this->beforeFilter('apiauth');
		$this->esquema = $this->getEsquema();
	}		
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	 
	$cant = (Request::get('cant') == '') ? 0 : Request::get('cant');
	$offset = (Request::get('offset') == '') ? 0 : Request::get('offset');

	if($cant>0){  // 
	 $odontologos = Odontologo::take($cant)->skip($offset)->get();
	} else {
	$odontologos = Odontologo::All();
	}
	    return Response::json(array(
		'error' => false,
		'esquema'=>$this->esquema,
		'odontologos' => $odontologos->toArray()),
		200
	    );

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$s = $this->odontologo->create(Input::all());
		 
		  if($s->isSaved())
		  {
		   return Response::json(array(
			'error'=>false,
			'esquema'=>$this->esquema,
			'odontologo'=>$odontologo->toArray()),
			200);
		  } else {
		   return Response::json(array(
			'error'=>true,
			'message'->$s->errors(),
			'esquema'=>$this->esquema,
			'odontologo'=>$odontologo->toArray()),
			200);
		  	
		  }
		 
		/*$odontologo = new Odontologo;
		$odontologo->nombres = Request::get('nombres');
		$odontologo->apellido = Request::get('apellido');
		$odontologo->matricula = Request::get('matricula');

		$odontologo->save();

		return Response::json(array(
			'error'=>false,
			'esquema'=>$this->esquema,
			'odontologo'=>$odontologo->toArray()),
			200);*/
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	    $odontologos = Odontologo::find($id);
	    //return $odontologos->toJson();	
		
	    return Response::json(array(
		'error' => false,
		'esquema'=>$this->esquema,
		'odontologos' => $odontologos->toArray()),
		200
	    );
		
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
		//
		$odontologo = Odontologo::find($id);
		$odontologo->nombres = Request::get('nombres');
		$odontologo->apellido = Request::get('apellido');
		$odontologo->matricula = Request::get('matricula');

		$odontologo->save();

		return Response::json(array(
			'error'=>false,
			'esquema'=>$this->esquema,
			'odontologo'=>$odontologo->toArray()),
			200);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		$odontologo = Odontologo::find($id);
		return Response::json(array('eliminado'=>$odontologo->delete()),200);
	}

	public function getEsquema(){
		return DB::select('SHOW COLUMNS from odontologos');
	}
}
