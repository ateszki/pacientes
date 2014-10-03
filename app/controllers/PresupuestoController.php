<?php

class PresupuestoController extends MaestroController {

	function __construct(){
		$this->classname= 'Presupuesto';
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
			return Response::json(array(
			'error'=>true,
			'mensaje' => 'Accion no disponible',
			),200);
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
			return Response::json(array(
			'error'=>true,
			'mensaje' => 'Accion no disponible',
			),200);
		
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
		$new["user_id_emision"] = Auth::user()->id;
		$modelo_presu = new Presupuesto();
		$presu = $modelo_presu->create($new);
		if ($presu->save()){
				$this->eventoAuditar($presu);
				if (count($items)){
				foreach($items as $item){
					$presu_lin = new PresupuestoLinea();
					$item['presupuesto_id']=$presu->id;
					$p_lin = $presu_lin->create($item);
					if(!$p_lin->save()){
						DB::rollback();
						return Response::json(array(
						'error'=>true,
						'mensaje' => HerramientasController::getErrores($p_lin->validator),
						'listado'=>$data,
						),200);
					
					}
				}
				}
				DB::commit();
				return Response::json(array(
				'error'=>false,
				//'listado'=>array($ctacte->with('lineas_factura','lineas_recibo')->where('id','=',$ctacte->id)->get()->toArray())),
				'listado'=>$presu->where('id','=',$presu->id)->get()->toArray()),
				200);
			} else {
				DB::rollback();
				return Response::json(array(
				'error'=>true,
				'mensaje' => HerramientasController::getErrores($presu->validator),
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
		$modelo_presu = new Presupuesto();
		$presu = $modelo_presu->find($id);
		$presu->fill($new);
		if ($presu->save()){
				$this->eventoAuditar($presu);
				if (count($items)){
				foreach($items as $item){
					$lineas = $presu->lineas();
					foreach($lineas as $l){
						$l->delete();
					}
					$presu_lin = new PresupuestoLinea();
					$item['presupuesto_id']=$presu->id;
					$p_lin = $presu_lin->create($item);
					if(!$p_lin->save()){
						DB::rollback();
						return Response::json(array(
						'error'=>true,
						'mensaje' => HerramientasController::getErrores($p_lin->validator),
						'listado'=>$data,
						),200);
					
					}
				}
				}
				DB::commit();
				return Response::json(array(
				'error'=>false,
				//'listado'=>array($ctacte->with('lineas_factura','lineas_recibo')->where('id','=',$ctacte->id)->get()->toArray())),
				'listado'=>$presu->where('id','=',$presu->id)->get()->toArray()),
				200);
			} else {
				DB::rollback();
				return Response::json(array(
				'error'=>true,
				'mensaje' => HerramientasController::getErrores($presu->validator),
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
	
	
	public function traerPresupuesto($id){
		try {
			$mov = Presupuesto::findOrFail($id);
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
			$items = Presupuesto::findOrFail($id)->lineas()->get();
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
			$presu = Presupuesto::findOrFail($id);
			$lineas = $presu->lineas();
			foreach($lineas as $l){
				$l->delete();
			}
			$presu->delete();
				return Response::json(array(
				'error'=>false,
				'mensaje'=>'Presupuesto '.$id.' eliminado correctamente'; 
				'listado'=>$presu->toArray()),
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
