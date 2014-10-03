<?php

class PlanPrepagaController extends MaestroController {

	function __construct(){
		$this->classname= 'PlanPrepaga';
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
	
	public function nomencladorLista($id){
	$pp = $this->modelo->find($id);
	$lpnmodelo = new ListaPreciosNomenclador();
	$lpn = $lpnmodelo->where('listas_precios_id','=',$pp->lista_precios_id)->with('nomenclador','listas_precios','grupo_dental')->get();
	$listado = array();
	foreach ($lpn as $l){
		$obj = $l->toArray();
		unset($obj["nomenclador"]);
		unset($obj["listas_precios"]);
		$obj["codigo_nomenclador"] = $l->nomenclador->codigo;
		$obj["descripcion_nomenclador"] = $l->nomenclador->descripcion;
		$obj["item_bas"] = $l->nomenclador->item_bas;
		$obj["tasa_iva"] = $l->nomenclador->tasa_iva();
		$obj["codigo_lista_precios"] = $l->listas_precios->codigo;
		$obj["grupo_dental"] = $l->grupo_dental->descripcion;
		$listado[] = $obj; 

	}
	$lpn1 = $lpnmodelo->where('listas_precios_id','=',$pp->lista_basica_id)->whereNotIn('nomenclador_id',function($query) use ($pp){
					$query->select('nomenclador_id')->from('listas_precios_nomenclador')->where('listas_precios_id','=',$pp->lista_precios_id);
					})->with('nomenclador','listas_precios','grupo_dental')->get();
	foreach ($lpn1 as $l){
		
		$obj = $l->toArray();
		unset($obj["nomenclador"]);
		unset($obj["listas_precios"]);
		$obj["codigo_nomenclador"] = $l->nomenclador->codigo;
		$obj["descripcion_nomenclador"] = $l->nomenclador->descripcion;
		$obj["item_bas"] = $l->nomenclador->item_bas;
		$obj["tasa_iva"] = $l->nomenclador->tasa_iva();
		$obj["codigo_lista_precios"] = $l->listas_precios->codigo;
		$obj["grupo_dental"] = $l->grupo_dental->descripcion;
		$listado[] = $obj; 

	}

	return Response::json(array(
	'error' => false,
	'listado' => $listado),
	200
	);

	}

}
