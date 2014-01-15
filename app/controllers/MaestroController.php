<?php

class MaestroController extends \BaseController {

	public $classname = NULL;
	public $modelo = NULL;
	public function __construct(){
	

	}

	public function postBuscar(){
		$classname = $this->classname;
	try {
	    $m = $classname::whereRaw('1=1');
	    $m->where(function($query){
	    $parametros = Input::all();
	    unset($parametros['apikey']);
	    unset($parametros['session_key']);

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
				if($valor=='null'){
					$tipo_busqueda_null = $tipo_busqueda.'Null';
					$query->$tipo_busqueda_null($columna);
				} else {
					$query->$tipo_busqueda($columna,$valor);
				}
			}
		}

		});		

	$listado = $m->get();
		return Response::json(array(
		'error' => false,
		'listado' => $listado->toArray()),
		200
	    );
	} catch (Exception $e){
			return Response::json(array(
			'error' => true,
			'mensaje' => $e->getMessage()),
			200
		    );
	}
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
	try {
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

	} catch (Exception $e){
			return Response::json(array(
			'error' => true,
			'mensaje' => $e->getMessage()),
			200
		    );
	}
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
	try {
		$new = Input::all();
		unset($new['apikey']);
//hash passwords for users
if (isset($new["password"])&& !empty($new["password"])){
	$new["password"] = Hash::make($new["password"]);
}

//cambiar 'NUUL? por NULL
$new = array_map(function($n){return ($n == 'NULL')?NULL:$n;}, $new);
		$new_modelo = $this->modelo->create($new);

		if ($new_modelo->save()){
		   return Response::json(array(
			'error'=>false,
			'listado'=>array($this->modelo->find($new_modelo->id)->toArray())),
			200);
		} else {
			return Response::json(array(
                        'error'=>true,
                        'mensaje' => HerramientasController::getErrores($new_modelo->validator),
                        'listado'=>$new,
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
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	try{
	    $modelo = $this->modelo->find($id);
		
	    return Response::json(array(
		'error' => false,
		'listado' => $modelo->toArray()),
		200
	    );
		
	} catch (Exception $e){
			return Response::json(array(
			'error' => true,
			'mensaje' => $e->getMessage()),
			200
		    );
	}
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
	
	try{	
		$modelo = $this->modelo->find($id);
		$data = Input::all();
		unset($data['apikey']);
//hash passwords for users
if (isset($data["password"])&& !empty($data["password"])){
	$data["password"] = Hash::make($data["password"]);
}

//cambiar 'NUUL? por NULL
$data = array_map(function($n){return ($n == 'NULL')?NULL:$n;}, $data);
		$modelo->fill($data);
		if ($modelo->save() !== false){

			return Response::json(array(
			'error'=>false,
			'listado'=>$modelo->toArray()),
			200);
		}else {
			
			 return Response::json(array(
                        'error'=>true,
                        'mensaje' => HerramientasController::getErrores($modelo->validator),
                        'listado'=>$modelo->toArray(),
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

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
	try{	//
		$modelo = $this->modelo->find($id);
			$eliminado = $modelo->delete();
			return Response::json(array('error'=>false,'eliminado'=>$eliminado),200);
		}catch(Exception $e){
			 return Response::json(array(
                        'error'=>true,
                        'mensaje' => $e->getMessage(),
                        'listado'=>$modelo->toArray(),
                        ),200);
		}
	}

}
