<?php
//use Illuminate\Database\Eloquent\ModelNotFoundException;
class PrepagaController extends MaestroController {

	function __construct(){
		$this->classname= 'Prepaga';
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

	public function pacientes($id){
	try {	
		$pacientes = Prepaga::findOrFail($id)->pacientes()->get();
		return Response::json(array(
                'error' => false,
                'listado' => $pacientes->toArray()),
                200
            );
	}catch (Exception $e){
		return Response::json(array('error'=>true,'mensaje'=>$e->getMessage()?:'No se encuentra el recurso: '.$id),200);
	}


	}

	public function setPaciente($id,$paciente_id){
		try {
		Prepaga::find($id)->pacientes()->attach($paciente_id);
		return Response::json(array('error'=>false),200);
		} catch (Exception $e){
		return Response::json(array('error'=>true,'mensaje'=>$e->getMessage()),200);
		}
	}

	public function unsetPaciente($id,$paciente_id){
		try {
		Paciente::find($id)->pacientes()->detach($paciente_id);
		return Response::json(array('error'=>false),200);
		} catch (Exception $e){
		return Response::json(array('error'=>true,'mensaje'=>$e->getMessage()),200);
		}
	}
}
