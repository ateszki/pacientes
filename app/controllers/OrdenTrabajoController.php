<?php

class OrdenTrabajoController extends MaestroController {

	function __construct(){
		$this->classname= 'OrdenTrabajo';
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
		$modelo_ot = new OrdenTrabajo();
		$OT = $modelo_ot->create($new);
		if ($OT->save()){
				$this->eventoAuditar($OT);
				if (count($items)){
				foreach($items as $item){
					$OT_lin = new OrdenTrabajoItem();
					$item['orden_trabajo_id']=$OT->id;
					$OT_lin = $OT_lin->create($item);
					if(!$OT_lin->save()){
						DB::rollback();
						return Response::json(array(
						'error'=>true,
						'mensaje' => HerramientasController::getErrores($OT_lin->validator),
						'listado'=>$data,
						),200);
					
					}
				}
				}
				DB::commit();
				return Response::json(array(
				'error'=>false,
				//'listado'=>array($ctacte->with('lineas_factura','lineas_recibo')->where('id','=',$ctacte->id)->get()->toArray())),
				'listado'=>$OT->where('id','=',$OT->id)->get()->toArray()),
				200);
			} else {
				DB::rollback();
				return Response::json(array(
				'error'=>true,
				'mensaje' => HerramientasController::getErrores($OT->validator),
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
		$modelo_ot = new OrdenTrabajo();
		$OT = $modelo_ot->find($id);
		$OT->fill($new);
		if ($OT->save()){
				$this->eventoAuditar($OT);
				if (count($items)){
				$lineas = $OT->items()->get();
				foreach($lineas as $l){
					$l->delete();
				}
				foreach($items as $item){
					$OT_lin = new OrdenTrabajoItem();
					$item['orden_trabajo_id']=$OT->id;
					$o_lin = $OT_lin->create($item);
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
				'listado'=>$OT->where('id','=',$OT->id)->get()->toArray()),
				200);
			} else {
				DB::rollback();
				return Response::json(array(
				'error'=>true,
				'mensaje' => HerramientasController::getErrores($OT->validator),
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
	
	
	public function traerOrdenTrabajo($id){
		try {
			$mov = OrdenTrabajo::findOrFail($id);
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
			$items = OrdenTrabajo::findOrFail($id)->items()->get();
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
			$OT = OrdenTrabajo::findOrFail($id);
			$items = $OT->items()->get();
			foreach($items as $i){
				$a = $i->delete();
			}
			$OT->delete();
				DB::commit();
				return Response::json(array(
				'error'=>false,
				'mensaje'=>'Orden de trabajo '.$id.' eliminada correctamente', 
				'listado'=>$OT->toArray()),
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
	/* ver si hace falta una funcion similar
	public function presupuestosPacienteVista($paciente_id){
		try {
			$p = Paciente::findOrFail($paciente_id);
			$OTpuestos1 = array();
			$OTpuestos = $p->presupuestos()->get();
			foreach ($OTpuestos as $OT){
				$coe = $OT->centroOdontologoEspecialidad()->first();
				$prepaga = $OT->pacientePrepaga()->first()->prepaga()->first();
				$OTpuestos1[] = array(
					"id"=>$OT->id,
					"fecha_emision"=>$OT->fecha_emision,
					"estado"=>(empty($OT->fecha_aprobacion))?'PROVISORIO':'APROBADO',
					"importe_bruto"=>$OT->importe_bruto,
					"odontologo"=>$coe->odontologo()->first()->nombreCompleto,
					"especialidad"=>$coe->especialidad()->first()->especialidad,
					"prepaga_codigo"=>$prepaga->codigo,
					"prepaga_razon"=>$prepaga->razon_social,
				);
			}
			return Response::json(array(
			'error'=>false,
			'listado'=>$OTpuestos1),
			200);
			
		}catch (Exception $e){
			return Response::json(array(
				'error' => true,
				'mensaje' => $e->getMessage()),
				200
				    );
		}
		
	}*/

	public function ordenesTrabajoPresupuesto($presupuesto_id){
		try {
			$p = Presupuesto::findOrFail($presupuesto_id);
			$OT = $p->ordenes_trabajo()->get();
			return Response::json(array(
			'error'=>false,
			'listado'=>$OT),
			200);
			
		}catch (Exception $e){
			return Response::json(array(
				'error' => true,
				'mensaje' => $e->getMessage()),
				200
				    );
		}
		
	}

	public function recibirRemito(){
		DB::beginTransaction();
		try
		{


		$data = Input::all();
		$new = $data;
		unset($new['apikey']);
		unset($new['session_key']);


		$fecha_devolucion = $new["fecha_devolucion"];
		$user_id_recibido = $new["user_id_recibido"];
		$remito_devolucion = $new["remito_devolucion"];
		$items = $new["items"];
		$estados = $new["estados"];
		$precios = $new["precios"];
		if (count($items)){
			foreach($items as $i => $item){
				$OT_lin = OrdenTrabajoItem::findOrfail($item);
				$OT_lin->fecha_devolucion = $fecha_devolucion;
				$OT_lin->estado_devolucion = (isset($estados[$i]))?$estados[$i]:NULL;
				$OT_lin->precio = (isset($precios[$i]))?$precios[$i]:NULL;
				$OT_lin->remito_devolucion = $remito_devolucion;
				$OT_lin->user_id_recibido = $user_id_recibido;

				if(!$OT_lin->save()){
					DB::rollback();
					return Response::json(array(
					'error'=>true,
					'mensaje' => HerramientasController::getErrores($OT_lin->validator),
					'listado'=>$data,
					),200);
				
				}
			}
		}
		DB::commit();
		return Response::json(array(
		'error'=>false,
		'listado'=>OrdenTrabajoItem::where('fecha_devolucion','=',$fecha_devolucion)->where('remito_devolucion','=',$remito_devolucion)->get()->toArray()),
		200);

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
	
	public function cancelarRecepcion(){
		try
		{


		$data = Input::all();
		$new = $data;
		unset($new['apikey']);
		unset($new['session_key']);

		$OT_lin = OrdenTrabajoItem::findOrfail($new["item"]);
		$OT_lin->fecha_devolucion = NULL;
		$OT_lin->estado_devolucion = NULL;
		$OT_lin->remito_devolucion = NULL;
		$OT_lin->user_id_recibido = NULL;
		$OT_lin->precio = NULL;

		if(!$OT_lin->save()){
			return Response::json(array(
			'error'=>true,
			'mensaje' => HerramientasController::getErrores($OT_lin->validator),
			'listado'=>$data,
			),200);
		
		}
		return Response::json(array(
		'error'=>false,
		'listado'=>$OT_lin->toArray()),
		200);

		} catch(\Exception $e)
			{
				return Response::json(array(
					'error' => true,
					'mensaje' => $e->getMessage()),
					200
				    );
			}

	} 
	

	public function ordenesTrabajoPaciente($paciente_id){
		try {
			$p = Paciente::findOrFail($paciente_id);
			$OTs = array();
			$presupuestos = $p->presupuestos()->get();
			foreach ($presupuestos as $presu){
				$presu_ots = $presu->ordenes_trabajo()->get()->toArray();
				$OTs = array_merge($OTs,$presu_ots);
			}
			return Response::json(array(
			'error'=>false,
			'listado'=>$OTs),
			200);
			
		}catch (Exception $e){
			return Response::json(array(
				'error' => true,
				'mensaje' => $e->getMessage()),
				200
				    );
		}
		
	}



}
