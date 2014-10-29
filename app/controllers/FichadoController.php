<?php

class FichadoController extends MaestroController {

	function __construct(){
		$this->classname= 'Fichado';
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
			return Response::json(array(
			'error'=>true,
			'mensaje' => 'Accion no disponible',
			),200);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return $this->crear();
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
		//return parent::update($id);
/*
			return Response::json(array(
			'error'=>true,
			'mensaje' => 'Accion no disponible',
			),200);
*/
		return $this->actualizar($id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//return parent::destroy($id);
	/*		return Response::json(array(
			'error'=>true,
			'mensaje' => 'Accion no disponible',
			),200);
		
	*/
			return $this->eliminar($id);
	}

	public function crear(){
		DB::beginTransaction();
		try
		{
		$data = Input::all();
		$new = $data;
		unset($new['apikey']);
		unset($new['session_key']);

		$items = array();

		$new = array_map(function($n){return ($n == 'NULL')?NULL:$n;}, $new);
		if(isset($new["items"])){	
			foreach ($new["items"] as $i => $item){
				$items[$i] = array_map(function($n){return ($n == 'NULL')?NULL:$n;},$item); 
			}
			unset($new["items"]);
		}
		//$new["user_id_emision"] = Auth::user()->id;
		$modelo_fichado = new Fichado();
		$F = $modelo_fichado->create($new);
		if ($F->save()){
				$this->eventoAuditar($F);
				if (count($items)){
				foreach($items as $item){
					$F_lin = new FichadoItem();
					$item['fichado_id']=$F->id;
					$F_lin = $F_lin->create($item);
					if(!$F_lin->save()){
						DB::rollback();
						return Response::json(array(
						'error'=>true,
						'mensaje' => HerramientasController::getErrores($F_lin->validator),
						'listado'=>$data,
						),200);
					
					}
				}
				}
				DB::commit();
				return Response::json(array(
				'error'=>false,
				//'listado'=>array($ctacte->with('lineas_factura','lineas_recibo')->where('id','=',$ctacte->id)->get()->toArray())),
				'listado'=>$F->where('id','=',$F->id)->get()->toArray()),
				200);
			} else {
				DB::rollback();
				return Response::json(array(
				'error'=>true,
				'mensaje' => HerramientasController::getErrores($F->validator),
				'listado'=>$data,
				),200);
			}

		

	} catch(\Exception $e)
			{
			    DB::rollback();
				return Response::json(array(
					'error' => true,
					'mensaje' => $e->getMessage()),
					200
				    );
			}
	} 
	public function actualizar($id){
		DB::beginTransaction();
		try
		{


		$data = Input::all();
		$new = $data;
		unset($new['apikey']);
		unset($new['session_key']);

		$items = array();

		$new = array_map(function($n){return ($n == 'NULL')?NULL:$n;}, $new);
		if(isset($new["items"])){	
			foreach ($new["items"] as $i => $item){
				$items[$i] = array_map(function($n){return ($n == 'NULL')?NULL:$n;},$item); 
			}
			unset($new["items"]);
		}
		$modelo_fichado = new Fichado();
		$F = $modelo_fichado->find($id);
		$F->fill($new);
		if ($F->save()){
				$this->eventoAuditar($F);
				if (count($items)){
				$lineas = $F->items()->get();
				foreach($lineas as $l){
					$l->delete();
				}
				foreach($items as $item){
					$F_lin = new FichadoItem();
					$item['fichado_id']=$F->id;
					$o_lin = $F_lin->create($item);
					if(!$o_lin->save()){
						DB::rollback();
						return Response::json(array(
						'error'=>true,
						'mensaje' => HerramientasController::getErrores($o_lin->validator),
						'listado'=>$data,
						),200);
					
					}
				}
				}
				DB::commit();
				return Response::json(array(
				'error'=>false,
				//'listado'=>array($ctacte->with('lineas_factura','lineas_recibo')->where('id','=',$ctacte->id)->get()->toArray())),
				'listado'=>$F->where('id','=',$F->id)->get()->toArray()),
				200);
			} else {
				DB::rollback();
				return Response::json(array(
				'error'=>true,
				'mensaje' => HerramientasController::getErrores($F->validator),
				'listado'=>$data,
				),200);
			}

		

	} catch(\Exception $e)
			{
			    DB::rollback();
				return Response::json(array(
					'error' => true,
					'mensaje' => $e->getMessage()),
					200
				    );
			}

	} 
	
	
	public function traerFichado($id){
		try {
			$mov = Fichado::findOrFail($id);
				return Response::json(array(
				'error'=>false,
				'listado'=>$mov->toArray()),
				200);

		}catch (Exception $e){
	
			return Response::json(array(
				'error' => true,
				'mensaje' => $e->getMessage()),
				200
				    );
		}

	}
	public function traerItems($id){
		try {
			$items = Fichado::findOrFail($id)->items()->get();
				return Response::json(array(
				'error'=>false,
				'listado'=>$items->toArray()),
				200);

		}catch (Exception $e){
	
			return Response::json(array(
				'error' => true,
				'mensaje' => $e->getMessage()),
				200
				    );
		}

	}
	public function eliminar($id){
		DB::beginTransaction();
		try {
			$F = Fichado::findOrFail($id);
			$items = $F->items()->get();
			foreach($items as $i){
				$a = $i->delete();
			}
			$F->delete();
				DB::commit();
				return Response::json(array(
				'error'=>false,
				'mensaje'=>'Fichado '.$id.' eliminado correctamente', 
				'listado'=>$F->toArray()),
				200);

		}catch (Exception $e){
	
			    DB::rollback();
			return Response::json(array(
				'error' => true,
				'mensaje' => $e->getMessage()),
				200
				    );
		}

	}
}
