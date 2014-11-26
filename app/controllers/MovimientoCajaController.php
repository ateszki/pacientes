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
                try {
                        $data = Input::all();
			$MC = new MovimientoCaja();
			$MC->fill($data);
			if ($MC->save()){
				$this->eventoAuditar($MC);
				return Response::json(array(
				'error'=>false,
				'listado'=>array($this->modelo->find($MC->id)->toArray())),
				200);
			} else {
				return Response::json(array(
				'error'=>true,
				'mensaje' => HerramientasController::getErrores($MC->validator),
				'listado'=>$new,
				),200);
			}
                } catch (Exception $e){
                        return Response::json(array(
                        'error' => true,
                        'mensaje' => $e->getMessage()),
                        200
                        );
                }
        }


}
