<?php

class MaestroController extends \BaseController {

	public $classname = NULL;
	public $modelo = NULL;
	public function __construct(){
	

	}

	public function getErrors($messages){

			$errormessages = array("error"=>"");
			foreach ($messages as $v){
				if(is_array($v)){$errormessages["error"] .= " | ".implode(',',$v);} else {$errormessages["error"] .= " | ".$v;}
			}
			if(strlen($errormessages["error"])){$errormessages["error"] = substr($errormessages["error"],3);}
			 return array($errormessages["error"]);
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
		var_dump($new_modelo->razonsocial);		

		if ($new_modelo->save()){
		   return Response::json(array(
			'error'=>false,
			'envio'=>array($new_modelo->toArray())),
			200);
		} else {
			$messages = $new_modelo->validator->messages();//->toArray();
			return Response::json(array(
                        'error'=>true,
                        'mensaje' => array($messages->all()),
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
			
			$messages = $modelo->validator->messages();
			 return Response::json(array(
                        'error'=>true,
                        'mensaje' => $messages->all(),
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
		return Response::json(array('eliminado'=>$modelo->delete()),200);
	}

}
