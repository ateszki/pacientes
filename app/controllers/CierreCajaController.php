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
			$movimientos = DB::select('select medios_pago_caja_id,sum(importe) as importe from movimientos_cajas where caja_id = ? and cierres_cajas_id is null group by medios_pago_caja_id',array($caja_id));
			if(count($movimientos)){
				$cierre = new CierreCaja();
				$data = array('user_id'=>Auth::user()->id,'caja_id'=>$caja_id,'fecha'=>date("Y-m-d"),"hora"=>date("H:i:s"));
				$cierre->fill($data);
				if ($cierre->save()){
					foreach ($movimientos as $mov){
						$cci = new CierreCajaItem();
						$mov->cierres_cajas_id= $cierre->id;
						$mov = (array) $mov;
						$cci->fill($mov);
						if(!$cci->save()){
							DB::rollback();
							return Response::json(array(
								'error'=>true,
								'mensaje' => HerramientasController::getErrores($cci->validator),
								'listado'=>$mov,
								),200);
						}
					}
						DB::statement('update movimientos_cajas set cierres_cajas_id = ? where caja_id = ? and cierres_cajas_id is null',array($cierre->id,$caja_id));
						DB::commit();
						return Response::json(array(
					'error'=>false,
					'listado'=>$cierre->toArray()),
					200);
				} else {
					DB::rollback();
					return Response::json(array(
						'error'=>true,
						'mensaje' => HerramientasController::getErrores($cierre->validator),
						'listado'=>$data,
						),200);
				}
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
			$ultimo_cierre = CierreCaja::where('caja_id','=',$caja_id)->orderBy('fecha', 'desc')->orderBy('hora','desc')->take(1)->first();
			$movimientos = DB::select("select m.medios_pago_caja_id,concat(mp.medio_pago,' (',mp.moneda,')') as medio_pago,sum(m.importe) as importe from movimientos_cajas m inner join medios_pago_caja mp on m.medios_pago_caja_id = mp.id where m.caja_id = ? and m.cierres_cajas_id is null group by m.medios_pago_caja_id",array($caja_id));
			
			if(count($ultimo_cierre)){
				dd($ultimo_cierre->items());$cierre_items = $ultimo_cierre->items();
				$movimientos = array_merge($movimientos,$cierre_items);
			}
			return Response::json(array(
					'error'=>false,
					'listado'=>$movimientos),
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
}
