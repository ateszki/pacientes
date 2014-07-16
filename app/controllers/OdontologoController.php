<?php

class OdontologoController extends MaestroController {

	public function __construct(){
		$this->classname = 'Odontologo';
		$this->modelo = new $this->classname();
	}		

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return parent::index();	 

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
		return 	parent::store();
/*
		$odontologo = new Odontologo;
		$new = Input::all();
		unset($new['apikey']);
		$new_odontologo = $odontologo->create($new);

		if ($new_odontologo->save()){
		   //$odontologo = $odontologo->create($new);
		   return Response::json(array(
			'error'=>false,
			'odontologo'=>array($new_odontologo->toArray())),
			200);
		} else {
*/			/*
			$messages = $new_odontologo->validator->messages()->toArray();
			$errormessages = array("error"=>"");
			foreach ($messages as $v){
				if(is_array($v)){$errormessages["error"] .= " | ".implode(',',$v);} else {$errormessages["error"] .= " | ".$v;}
			}
			if(strlen($errormessages["error"])){$errormessages["error"] = substr($errormessages["error"],3);}
			//var_dump($messages->toArray()); 
			*/
/*			return Response::json(array(
                        'error'=>true,
                        'mensaje' => HerramientasController::getErrores($new_odontologo->validator),//array($errormessages),
                        'odontologo'=>$new,
                        ),200);

		}
*/		 
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
		/*
		$odontologo = Odontologo::find($id);
		*/
		/*
		$odontologo->nombres = Request::get('nombres');
		$odontologo->apellido = Request::get('apellido');
		$odontologo->matricula = Request::get('matricula');
		*/
		/*
		$data = Input::all();
		unset($data['apikey']);

		if(isset($data["matricula"]) && $odontologo->matricula == $data['matricula']){
			$odontologo->rules["matricula"] .= ',matricula,'.$odontologo->id;
		}
		if(!isset($data["matricula"])){
			$odontologo->rules["matricula"] .= ',matricula,'.$odontologo->id;
		}

		foreach ($data as $k => $v) {
			$odontologo->$k = $v;
		}
		//$v = $odontologo->validate($data);
		if ($odontologo->save() !== false){

			$odontologo->save($data);

			return Response::json(array(
			'error'=>false,
			'odontologo'=>$odontologo->toArray()),
			200);
		}else {
			
			$messages = $odontologo->validator->messages();
			 return Response::json(array(
                        'error'=>true,
                        'mensaje' => $messages->all(),
                        'odontologo'=>$odontologo->toArray(),
                        ),200);
		}
		*/
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

	public function centros_especialidades($id){
	    //$ce = Odontologo::find($id)->centrosEspecialidades()->with(array('Especialidad','Centro'))->get();
	$ce = Odontologo::findOrFail($id)->vistaCentrosespecialidades();
	    return Response::json(array(
		'error' => false,
		'listado' => $ce),
		200
	    );

	}

	public function ver_ausencias($id){
		$params = Input::all();
		$desde = (isset($params["desde"])&& !empty($params["desde"]))?$params["desde"]:date("Y-m-d");	
		$hasta = (isset($params["hasta"])&& !empty($params["hasta"]))?$params["hasta"]:date("Y-m-d",strtotime($desde." +90 days"));	
		$ausencias = Odontologo::find($id)->ausencias()->where("fecha_hasta",">=",$desde)->where("fecha_desde","<=",$hasta)->get();
		    return Response::json(array(
			'error' => false,
			'listado' => $ausencias->toArrayFechas()),
			200
		    );

	}
}
