<?php

class CentroOdontologoEspecialidadController extends MaestroController {

	function __construct(){
		$this->classname= 'CentroOdontologoEspecialidad';
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

	public function agendas($id){
		
		$agendas = CentroOdontologoEspecialidad::find($id)->agendas()->get();
return Response::json(array(
                'error' => false,
                'listado' => $agendas->toArray()),
                200
            );
	

	}

	public function vista_detallada(){
	$listado = $this->modelo->vistaDetalladaOdontologosAlta();
	    return Response::json(array(
		'error' => false,
		'listado' => $listado),
		200
	    );

	}
	
	public function generarAgendas(){
		$hoy = date('Y-m-d');	
		
		$coes = CentroOdontologoEspecialidad::where('habilitado','=',1);
		
		$odontologos = array();
		foreach ($coes as $coe){
			$especialidad = $coe->especialidad;
			$odontologo = $coe->odontologo;
			$odontologos[] = $odontologo->id;
			echo $especialidad->lapso;
			
		}
		var_dump($odontologos);
	}
}
