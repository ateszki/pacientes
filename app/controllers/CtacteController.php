<?php

class CtacteController extends MaestroController {

	function __construct(){
		$this->classname= 'Ctacte';
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
		if (Input::has(array('importe_bruto','importe_neto','importe_iva'))){
			$importe_neto = Input::get('importe_neto'); 
			$importe_bruto = Input::get('importe_bruto'); 
			$importe_iva = Input::get('importe_iva');
			
			if (!$this->checkImportes($id,$importe_neto,$importe_bruto,$importe_iva)){
					return Response::json(array(
					'error'=>true,
					'mensaje' => 'No coinciden los importes',
					'listado'=>Input::all(),
					),200);
			}
 
		}
		return parent::update($id);
	}

	private function checkImportes($id,$neto,$bruto,$iva){
		if ($bruto != $neto+$iva){
			return false;
		} else {
			$ctacte = Ctacte::where('id','=',$id)->get();
			$lineas = $ctacte->lineas_factura();
			$total_lineas = 0;
			foreach ($lineas as $lin){
				$total_lineas += $lin->importe;
			}
			return ($neto == $total_lineas);
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
		return parent::destroy($id);
	}

	public function crear(){
		DB::beginTransaction();
		try
		{
		$data = Input::all();
		$new = $data;
		unset($new['apikey']);
		unset($new['session_key']);

		$new = array_map(function($n){return ($n == 'NULL')?NULL:$n;}, $new);
		$items = $new["items"];
		unset($new["items"]);
		$pagos = $new["pago"]; 
		unset($new["pago"]);
		$new["user_id"] = Auth::user()->id;
		$modelo_ctacte = new Ctacte();
		$ctacte = $modelo_ctacte->create($new);
		if ($ctacte->save()){
				$this->eventoAuditar($ctacte);

				foreach($items as $item){
					$ctacte_fac_lin = new CtacteFacLin();
					$item['ctacte_id']=$ctacte->id;
					$fac_lin = $ctacte_fac_lin->create($item);
					if(!$fac_lin->save()){
						DB::rollback();
						return Response::json(array(
						'error'=>true,
						'mensaje' => HerramientasController::getErrores($fac_lin->validator),
						'listado'=>$data,
						),200);
					
					}
				}
				foreach($pagos as $pago){
					$ctacte_rec_lin = new CtacteRecLin();
					$pago['ctacte_id']=$ctacte->id;
					$rec_lin = $ctacte_rec_lin->create($pago);
					if(!$rec_lin->save()){
						DB::rollback();
						return Response::json(array(
						'error'=>true,
						'mensaje' => HerramientasController::getErrores($rec_lin->validator),
						'listado'=>$data,
						),200);
					
					}
				}
				DB::commit();
				return Response::json(array(
				'error'=>false,
				'listado'=>array($ctacte->with('lineas_factura','lineas_recibo')->where('id','=',$ctacte->id)->get()->toArray())),
				200);
			} else {
				DB::rollback();
				return Response::json(array(
				'error'=>true,
				'mensaje' => HerramientasController::getErrores($ctacte->validator),
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
}
