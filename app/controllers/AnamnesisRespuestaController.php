<?php

class AnamnesisRespuestaController extends MaestroController {

	function __construct(){
		$this->classname= 'AnamnesisRespuesta';
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

	public function responder(){
		try {
			DB::beginTransaction();

			$data = Input::all();
			$new = $data;
			unset($new['apikey']);
			unset($new['session_key']);
			

			if(isset($new["respuesta"])){
 
			foreach ($new["respuesta"] as $i => $r){
				$respuesta = array(
					"paciente_id" => $new["paciente_id"],
					"anamnesis_pregunta_id" => $new["pregunta"][$i],
					"respuesta" => $r,
				);
				$AR = AnamnesisRespuesta::create($respuesta);
				if ($AR->save()){
					$this->eventoAuditar($AR);
				} else{ 
					DB::rollback();
					return Response::json(array(
					'error'=>true,
					'mensaje' => HerramientasController::getErrores($AR->validator),
					'listado'=>$data,
					),200);
				}
			}
			DB::commit();
			return Response::json(array(
			'error'=>false,
			'listado'=>$new),
			200);


			}

		}  catch(\Exception $e){
				DB::rollback();
				return Response::json(array(
				'error' => true,
				'mensaje' => $e->getMessage()),
				200
				);
		}
	}
}
