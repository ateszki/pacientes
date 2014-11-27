<?php

class MovimientoCajaController extends MaestroController {

	function __construct(){
		$this->classname= 'MovimientoCaja';
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
        public function transferencia(){
		DB::beginTransaction();
                try {
                        $data = Input::all();
			unset($data['apikey']);
			unset($data['session_key']);
			$MC_salida = new MovimientoCaja();
			$MC_entrada = new MovimientoCaja();
			$salida = $data;
			$salida["fecha"] = date("Y-m-d");
			$salida["hora"] = date("H:i");
			$salida["user_id"] = Auth::user()->id;
			$entrada = $salida;
			$entrada["caja_ref_id"] = $data["caja_id"];
			$entrada["caja_id"] = $data["caja_ref_id"];
			$entrada["ingreso_egreso"] = "I"; 
			$MC_salida->fill($salida);
			$MC_entrada->fill($entrada);
			if ($MC_salida->save() && $MC_entrada->save()){
				$this->eventoAuditar($MC_salida);
				$this->eventoAuditar($MC_entrada);
				DB::commit();
				return Response::json(array(
				'error'=>false,
				'listado'=>array($this->modelo->find($MC_salida->id)->toArray(),$this->modelo->find($MC_entrada->id)->toArray())),
				200);
			} else {
				DB::rollback();
				return Response::json(array(
				'error'=>true,
				'mensaje' => array_merge(HerramientasController::getErrores($MC_salida->validator),HerramientasController::getErrores($MC_entrada->validator)),
				'listado'=>$data,
				),200);
			}
                } catch (Exception $e){
			DB::rollback();
                        return Response::json(array(
                        'error' => true,
                        'mensaje' => $e->getMessage()),
                        200
                        );
                }
        }

	public function ingresoCtaCte($ctacte_id){
		DB::begintransaction();
		try {
			$CC = Ctacte::findOrFail($ctacte_id);
			$data = array(
				"caja_id" => $CC->caja_id,
				"importe" => 0,
				"ingreso_egreso" => "I",
				"fecha" => date("Y-m-d"),
				"hora" => date("H:i"),
				"user_id" => Auth::user()->id,
				"tipo_mov_caja_id" => 2, //ingreso por ctacte
				"medios_pago_caja_id" => NULL, 
				
			);
			$lineas_rec = $CC->->lineas_recibo()->get();
			foreach ($lineas_rec as $pago){
				$MC = new MovimientoCaja();
				$data_pago = $data;
				$data_pago["importe"]=> $pago->importe;
				$query = MedioPagoCaja::where('tipo','=',$pago->tipo);
				if($pago->tipo_cambio > 0){
					$query->where('moneda','=','DOL');
				} else {
					$query->where('moneda','=','ARS');
				}
				$MP = $query->first();
				$data_pago["medios_pago_caja_id"] = $MP->id;
				$MC->fill($data_pago);
				if($MC->save){
				if ($MC->save()){
					$this->eventoAuditar($MC);
					DB::commit();
					return Response::json(array(
					'error'=>false,
					'listado'=>array($this->modelo->find($MC->id)->toArray())),
					200);
				} else {
					DB::rollback();
					return Response::json(array(
					'error'=>true,
					'mensaje' => HerramientasController::getErrores($MC->validator),
					'listado'=>$data,
					),200);
				}
			}
                } catch (Exception $e){
			DB::rollback();
                        return Response::json(array(
                        'error' => true,
                        'mensaje' => $e->getMessage()),
                        200
                        );
                }
	}
}
