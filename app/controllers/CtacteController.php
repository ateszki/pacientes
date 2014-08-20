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

	public function crear(){
		$nThis = $this;
		DB::transaction(function() use($nThis)
		{
		$data = Input::all();
		$new = $data;
		unset($new['apikey']);
		unset($new['session_key']);

		$new = array_map(function($n){return ($n == 'NULL')?NULL:$n;}, $new);
		$items = $new["items"];
		unset($new["items"]);
		$pagos = $new["pagos"]; 
		unset($new["pagos"]);
		$new["user_id"] = Auth::user()->user_id;
		$modelo_ctacte = new Ctacte();
		$ctacte = $modelo_ctacte->create($new);
		if ($ctacte->save()){
		var_dump('q');	
				$this->eventoAuditar($ctacte);

				foreach($items as $item){
					$ctacte_fac_lin = new CtacteFacLin();
					$item['ctacte_id']=$ctacte->id;
					$fac_lin = $ctacte_fac_lin->create($item);
					var_dump($fac_lin->cantidad);
					if(!$fac_lin->save()){
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
						return Response::json(array(
						'error'=>true,
						'mensaje' => HerramientasController::getErrores($rec_lin->validator),
						'listado'=>$data,
						),200);
					
					}
				}

				return Response::json(array(
				'error'=>false,
				'listado'=>array($catcte->toArray())),
				200);
			} else {
				var_dump(Response);
				return Response::json(array(
				'error'=>true,
				'mensaje' => HerramientasController::getErrores($ctacte->validator),
				'listado'=>$data,
				),200);
			}

		});

	}
}
