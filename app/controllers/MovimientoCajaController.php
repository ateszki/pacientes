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
		if(Input::get("tipo_mov_caja_id")==1){
			return $this->transferencia();
		}
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
			$data = array_map(function($n){return ($n == 'NULL')?NULL:$n;}, $data);
			$MC_salida = new MovimientoCaja();
			$MC_entrada = new MovimientoCaja();
			$salida = $data;
			//$salida["fecha"] = date("Y-m-d");
			//$salida["hora"] = date("H:i:s");
			//$salida["user_id"] = Auth::user()->id;
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
				$mensaje = array();
				if($MC_entrada->validator != NULL){
					$mensaje[] = HerramientasController::getErrores($MC_entrada->validator);
				}
				if($MC_salida->validator != NULL){
					$mensaje[] = HerramientasController::getErrores($MC_salida->validator);
				}
				return Response::json(array(
				'error'=>true,
				'mensaje' => $mensaje,
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

	public function informe(){
		try{
			$data = Input::all();
			$desde = $data["desde"];
			$hasta = $data["hasta"];
			$query = MovimientoCaja::where('fecha','>=',$desde)->where('fecha','<=',$hasta);

			if(isset($data["caja_id"]) && !empty($data["caja_id"])){
				$query->where("caja_id","=",$data["caja_id"]);
			}

			if(isset($data["tipo_mov_caja_id"]) && !empty($data["tipo_mov_caja_id"])){
				$query->where("tipo_mov_caja_id","=",$data["tipo_mov_caja_id"]);
			}


			return Response::json(array(
			'error'=>false,
			'listado'=>$query->get()),
			200);

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
