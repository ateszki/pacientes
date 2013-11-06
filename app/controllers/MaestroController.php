<?php

class MaestroController extends \BaseController {

	public $classname = NULL;
	public $modelo = NULL;
	public function __construct(){
	

	}

	public function postBuscar(){
		$classname = $this->classname;
		$m = $classname::whereRaw('1=1');
$m->where(function($query){
	    $parametros = Input::all();
	    unset($parametros['apikey']);

		//tipo busqueda
		if(isset($parametros["tipo_busqueda"]) && $parametros["tipo_busqueda"]=='and'){
			$tipo_busqueda = "where";
		} else {
			$tipo_busqueda = "orWhere";
		}
		unset($parametros["tipo_busqueda"]);
		//comparacion
		if(isset($parametros["comparacion_busqueda"]) && $parametros["comparacion_busqueda"] == 'exacto'){
			$comparacion = 'exacto';
		}else{
			$comparacion = 'like';
		}
		unset($parametros["comparacion_busqueda"]);
		
		foreach ($parametros as $columna => $valor){
			if($comparacion == 'like' ){
				$query->$tipo_busqueda($columna,'like','%'.$valor.'%');	
			} else {
				$query->$tipo_busqueda($columna,$valor);
			}
		}

});		

	$listado = $m->get();
//$queries = DB::getQueryLog();
//$last_query = end($queries);	
		return Response::json(array(
		'error' => false,
//		'query' => $last_query,
		'listado' => $listado->toArray()),
		200
	    );

	}


	/*public function getErrors($messages){

			$errormessages = array("error"=>"");
			foreach ($messages as $v){
				if(is_array($v)){$errormessages["error"] .= " | ".implode(',',$v);} else {$errormessages["error"] .= " | ".$v;}
			}
			if(strlen($errormessages["error"])){$errormessages["error"] = substr($errormessages["error"],3);}
			 return array($errormessages["error"]);
	}
	*/		
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
	 $listado = $this->modelo->take($cant)->skip($offset)->get();
	} else {
	$listado = $this->modelo->All();
	}
	    return Response::json(array(
		'error' => false,
		'listado' => $listado->toArray()),
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
		$new = Input::all();
		unset($new['apikey']);
		$new_modelo = $this->modelo->create($new);

		if ($new_modelo->save()){
		   return Response::json(array(
			'error'=>false,
			'envio'=>array($new_modelo->toArray())),
			200);
		} else {
			return Response::json(array(
                        'error'=>true,
                        'mensaje' => HerramientasController::getErrores($new_modelo->validator),
                        'envio'=>$new,
                        ),200);

		}
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	    $modelo = $this->modelo->find($id);
		
	    return Response::json(array(
		'error' => false,
		'odontologos' => $modelo->toArray()),
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
		$modelo = $this->modelo->find($id);
		$data = Input::all();
		unset($data['apikey']);
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

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		$modelo = $this->modelo->find($id);
		try {
			$eliminado = $modelo->delete();
			return Response::json(array('error'=>false,'eliminado'=>$eliminado),200);
		}catch(Exception $e){
			 return Response::json(array(
                        'error'=>true,
                        'mensaje' => $e->getMessage(),
                        'envio'=>$modelo->toArray(),
                        ),200);
		}
	}

}
