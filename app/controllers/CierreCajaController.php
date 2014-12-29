<?php

class CierreCajaController extends MaestroController {

	function __construct(){
		$this->classname= 'CierreCaja';
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

	public function cerrar($caja_id){
		DB::beginTransaction();
		try {
			$salida = array();
			$medios_pagos = MedioPagoCaja::all();
			$ultimo_cierre = CierreCaja::where('caja_id','=',$caja_id)->orderBy('fecha', 'desc')->orderBy('hora','desc')->take(1)->first();
			$movimientos = DB::select("select m.medios_pago_caja_id,concat(mp.medio_pago,' (',mp.moneda,')') as medio_pago,sum(case m.ingreso_egreso when 'i' then m.importe else m.importe * -1 end ) as importe from movimientos_cajas m inner join medios_pago_caja mp on m.medios_pago_caja_id = mp.id where m.caja_id = ? and m.cierres_cajas_id is null group by m.medios_pago_caja_id",array($caja_id));
			if(count($movimientos)){
				$cierre = new CierreCaja();
				$data = array('user_id'=>Auth::user()->id,'caja_id'=>$caja_id,'fecha'=>date("Y-m-d"),"hora"=>date("H:i:s"));
				$cierre->fill($data);
				if ($cierre->save()){
					foreach ($medios_pagos as $mp){
						$salida[$mp->id] = array("cierres_cajas_id"=>$cierre->id,"medios_pago_caja_id"=> $mp->id,"importe"=> 0);
					}
					foreach ($movimientos as $mov){
						$salida[$mov->medios_pago_caja_id]["importe"] += $mov->importe;
					}
					if(count($ultimo_cierre)){
						$cierre_items = $ultimo_cierre->items()->get();
						foreach($cierre_items as $it){
							$salida[$it->medios_pago_caja_id]["importe"] += $it->importe;
						}
					}
					foreach ($salida as $ci_data){
						$cci = new CierreCajaItem();
						$cci->fill($ci_data);
						if(!$cci->save()){
							DB::rollback();
							return Response::json(array(
								'error'=>true,
								'mensaje' => HerramientasController::getErrores($cci->validator),
								'listado'=>$ci_data,
								),200);
						}
					}
						DB::statement('update movimientos_cajas set cierres_cajas_id = ? where caja_id = ? and cierres_cajas_id is null',array($cierre->id,$caja_id));
						DB::commit();
						return Response::json(array(
					'error'=>false,
					'listado'=>$cierre->items()->get()->toArray()),
					200);
				} else {
					DB::rollback();
					return Response::json(array(
						'error'=>true,
						'mensaje' => HerramientasController::getErrores($cierre->validator),
						'listado'=>$data,
						),200);
				}
			} else {
				return Response::json(array(
					'error'=>true,
					'mensaje' => "La caja no registra movimientos desde el ultimo cierre",
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
	public function saldos($caja_id){
		try {
			$salida = array();
			$medios_pagos = MedioPagoCaja::all();
			foreach ($medios_pagos as $mp){
				$salida[$mp->id] = array("medios_pago_caja_id"=> $mp->id,"medio_pago"=>$mp->medio_pago_moneda,"importe"=> 0);
			}
			$ultimo_cierre = CierreCaja::where('caja_id','=',$caja_id)->orderBy('fecha', 'desc')->orderBy('hora','desc')->take(1)->first();
			$movimientos = DB::select("select m.medios_pago_caja_id,concat(mp.medio_pago,' (',mp.moneda,')') as medio_pago,sum(case m.ingreso_egreso when 'i' then m.importe else m.importe * -1 end ) as importe from movimientos_cajas m inner join medios_pago_caja mp on m.medios_pago_caja_id = mp.id where m.caja_id = ? and m.cierres_cajas_id is null group by m.medios_pago_caja_id",array($caja_id));
			foreach ($movimientos as $m){
				$salida[$m->medios_pago_caja_id]["importe"] += $m->importe;
			}
			if(count($ultimo_cierre)){
				$cierre_items = $ultimo_cierre->items()->get();
				foreach($cierre_items as $it){
					$salida[$it->medios_pago_caja_id]["importe"] =(float) $salida[$it->medios_pago_caja_id]["importe"] + (float) $it->importe;
				}
			}
			return Response::json(array(
					'error'=>false,
					'listado'=>array_values($salida)),
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
	public function ultimo($caja_id){
		try {
			$salida = array();
			$listado = array();
			$medios_pagos = MedioPagoCaja::all();
			foreach ($medios_pagos as $mp){
				$salida[$mp->id] = array("medios_pago_caja_id"=> $mp->id,"medio_pago"=>$mp->medio_pago_moneda,"importe"=> 0);
			}
			$ultimo_cierre = CierreCaja::where('caja_id','=',$caja_id)->orderBy('fecha', 'desc')->orderBy('hora','desc')->take(1)->first();
			if(count($ultimo_cierre)){
				$uc = $ultimo_cierre->toArray();
				$cierre_items = $ultimo_cierre->items()->get();
				foreach($cierre_items as $it){
					$uc[$salida[$it->medios_pago_caja_id]["medio_pago"]]= $it->importe;
				}
				$listado[] = $uc;
			}
			return Response::json(array(
					'error'=>false,
					'listado'=>$listado),
					200);
		} catch(\Exception $e){
			return Response::json(array(
			'error' => true,
			'mensaje' => $e->getMessage()),
			200);
		}
	}
}
