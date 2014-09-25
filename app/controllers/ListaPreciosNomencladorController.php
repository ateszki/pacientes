<?php

class ListaPreciosNomencladorController extends MaestroController {

	function __construct(){
		$this->classname= 'ListaPreciosNomenclador';
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
	public function nomencladorLista($lista_id){
		$lpn = $this->modelo->where('listas_precios_id','=',$lista_id)->with('nomenclador','listas_precios','grupo_dental')->get();
	$listado = array();
	foreach ($lpn as $l){
		$obj = $l->toArray();
		unset($obj["nomenclador"]);
		unset($obj["listas_precios"]);
		$obj["codigo_nomenclador"] = $l->nomenclador->codigo;
		$obj["descripcion_nomenclador"] = $l->nomenclador->descripcion;
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
