<?php

class PacienteController extends MaestroController {

	function __construct(){
		$this->classname= 'Paciente';
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

	public function prepagas($id){
	try{	
		$prepagas = Paciente::findOrFail($id)->prepagas()->get();
		return Response::json(array(
                'error' => false,
                'listado' => $prepagas->toArray()),
                200
            );
	}catch (Exception $e){
		return Response::json(array('error'=>true,'mensaje'=>$e->getMessage()?:'No se encuentra el recurso:'.$id),200);
	}
	

	}

public function observaciones_detalladas($id){
	$paciente = Paciente::findOrFail($id);
	$observaciones = $paciente->observaciones()->with('user')->get();
	$detallado = array();
	foreach($observaciones as $obs){
		$detallado[] = array(
				"id" => $obs->id,
				"observacion" => $obs->observacion,
				"fecha_hora" => date('d-m-Y H:i',strtotime($obs->created_at)),
				"user_id" => $obs->user_id,
				"usuario" => $obs->user->nombre,
		);
	}
		return Response::json(array(
                'error' => false,
                'listado' => $detallado),
                200
		    );
}
	public function fichadosItems($paciente_id,$pieza_dental_id){
		try{
			$items1 = array();
			$items = Paciente::findOrFail($paciente_id)->fichadosItems()->where('pieza_dental_id','=',$pieza_dental_id)->get();
			foreach ($items as $i){
				$f = $i->fichado()->first();
				$it = $i->toArray();
				$it["odontologo"] = $f->centroOdontologoEspecialidad()->first()->odontologo()->first()->nombreCompleto;
				$it["tipo_fichado"] = $f->tipo_fichado;
				$it["fecha_emision"] = $f->fecha_emision;
				$items1[]= $it;
			}
			return Response::json(array(
			'error' => false,
			'listado' => $items1),
			200
		    );
		}catch (Exception $e){
			return Response::json(array('error'=>true,'mensaje'=>$e->getMessage()?:'No se encuentra el recurso:'.$id),200);
		}
		

	}
	public function fichados($id){
		try{	
			$fichados = Paciente::findOrFail($id)->fichados()->get();
			return Response::json(array(
			'error' => false,
			'listado' => $fichados->toArray()),
			200
		    );
		}catch (Exception $e){
			return Response::json(array('error'=>true,'mensaje'=>$e->getMessage()?:'No se encuentra el recurso:'.$id),200);
		}
		

	}

	public function fichadosVista($id){
		try {
			$p = Paciente::findOrFail($id);
			$fichados1 = array();
			$fichados = $p->fichados()->get();
			foreach ($fichados as $fich){
				$coe = $fich->centroOdontologoEspecialidad()->first();
				$fichados1[] = array(
					"id"=>$fich->id,
					"fecha_emision"=>$fich->fecha_emision,
					"tipo_fichado"=>$fich->tipo_fichado,
					"odontologo"=>$coe->odontologo()->first()->nombreCompleto,
				);
			}
			return Response::json(array(
			'error'=>false,
			'listado'=>$fichados1),
			200);
			
		}catch (Exception $e){
			return Response::json(array(
				'error' => true,
				'mensaje' => $e->getMessage()),
				200
				    );
		}
		
	}
	public function turnos($id){
		try{	
			$data = Input::all();
			$desde = (isset($data["desde"])?$data["desde"]:NULL);
			$hasta = (isset($data["hasta"])?$data["hasta"]:NULL);
			$presente = (isset($data["presente"])?$data["presente"]:NULL);

			$query = Paciente::findOrFail($id)->turnos();
if(!empty($presente)){
	$query->where("presente","=",$presente);
}

if(!empty($desde)){
	$query->wherehas('Agenda',function($q) use ($desde){
		$q->where('fecha','>=',$desde);
	});
}

if(!empty($hasta)){
	$query->wherehas('Agenda',function($q) use ($hasta){
		$q->where('fecha','<=',$hasta);
	});
}
			$turnos = $query->get();
			$salida = array();
			$turnos_salida = array();
			foreach ($turnos as $t){
				$agenda = $t->agenda()->first();
				$coe = $agenda->centroOdontologoEspecialidad()->first();
				$centro = $coe->centro;
				$odontologo = $coe->odontologo;
				$especialidad = $coe->especialidad;
				$salida["id"] = $t->id;
				$salida["presente"] = ($t->presente)?"SI":"NO";
				$salida["fecha"] = $agenda->fecha_arg;
				$salida["estado"] = $t->estado;
				$salida["hora_desde"] = $t->hora_desde;
				$salida["hora_hasta"] = $t->hora_hasta;
				$salida["fuera_de_agenda"] = ($t->fuera_de_agenda)?"SI":"NO";
				$salida["odontologo_id"] = $odontologo->id;
				$salida["odontologo"] = $odontologo->nombre_completo;
				$salida["especialidad_od"] = $especialidad->id;
				$salida["especialidad"] = $especialidad->especialidad;
				$salida["centro_id"] = $centro->id;
				$salida["centro"] = $centro->razonsocial;
				$turnos_salida[] = $salida;
			}
			return Response::json(array(
			'error' => false,
			'listado' => $turnos_salida),
			200
		    );
		}catch (Exception $e){
			return Response::json(array('error'=>true,'mensaje'=>$e->getMessage()?:'No se encuentra el recurso:'.$id),200);
		}
		

	}

	public function tratamientos($id){
		try{	
			$data = Input::all();
			$desde = (isset($data["desde"])?$data["desde"]:NULL);
			$hasta = (isset($data["hasta"])?$data["hasta"]:NULL);
			$presente = (isset($data["presente"])?$data["presente"]:NULL);

			$query = Paciente::findOrFail($id)->turnos();
			if(!empty($presente)){
				$query->where("presente","=",$presente);
			}

			if(!empty($desde)){
				$query->wherehas('Agenda',function($q) use ($desde){
					$q->where('fecha','>=',$desde);
				});
			}

			if(!empty($hasta)){
				$query->wherehas('Agenda',function($q) use ($hasta){
					$q->where('fecha','<=',$hasta);
				});
			}
			$turnos = $query->get();
			$salida = array();
			$turnos_salida = array();
			foreach ($turnos as $t){
				$agenda = $t->agenda()->first();
				$coe = $agenda->centroOdontologoEspecialidad()->first();
				$centro = $coe->centro;
				$odontologo = $coe->odontologo;
				$especialidad = $coe->especialidad;
				$salida["id"] = $t->id;
				$salida["presente"] = ($t->presente)?"SI":"NO";
				$salida["fecha"] = $agenda->fecha_arg;
				$salida["estado"] = $t->estado;
				$salida["hora_desde"] = $t->hora_desde;
				$salida["hora_hasta"] = $t->hora_hasta;
				$salida["fuera_de_agenda"] = ($t->fuera_de_agenda)?"SI":"NO";
				$salida["odontologo_id"] = $odontologo->id;
				$salida["odontologo"] = $odontologo->nombre_completo;
				$salida["especialidad_od"] = $especialidad->id;
				$salida["especialidad"] = $especialidad->especialidad;
				$salida["centro_id"] = $centro->id;
				$salida["centro"] = $centro->razonsocial;
				$salida["tratamiento_id"] = NULL;
				$salida["codigo_nomenclador"] = NULL;
				$salida["descripcion_nomenclador"] = NULL;
				$salida["diente"] = NULL;
				$salida["caras"] = NULL;
				$salida["fecha_carga_tratamiento"] = NULL;
				$tratamientos = $t->tratamientos()->get();
				if(count($tratamientos)){
					foreach($tratamientos as $t1){
						$salida["tratamiento_id"] = $t1->id;
						$salida["codigo_nomenclador"] = $t1->nomenclador()->first()->codigo;
						$salida["descripcion_nomenclador"] = $t1->nomenclador()->first()->descripcion;
						$salida["diente"] = ($t1->pieza_dental()!=null)?$t1->pieza_dental()->first()->diente:null;
						$salida["caras"] = $t1->caras;
						$salida["fecha_carga_tratamiento"] = $t1->fecha_carga;
						$turnos_salida[] = $salida;
					}
				} else {
					$turnos_salida[] = $salida;
				}
			}
			return Response::json(array(
			'error' => false,
			'listado' => $turnos_salida),
			200
		    );
		}catch (Exception $e){
			return Response::json(array('error'=>true,'mensaje'=>$e->getMessage()?:'No se encuentra el recurso:'.$id),200);
		}
		

	}

	public function planes_tratamientos($paciente_id){
		try {
			$pax = Paciente::findOrFail($paciente_id);
			$pts = $pax->planes_tratamientos()->get();
			$salida = array();
			if(count($pts)){
				foreach ($pts as $pt){
					$p = $pt->toArray();
					//$p = array();
					//$p["fecha"] = $pt->fecha;
					//$p["diagnostico"] = $pt->diagnostico;
					$p["odontologo"] = $pt->odontologo()->first()->nombre_completo;
					$p["especialidad"] = $pt->especialidad()->first()->especialidad;
					$p["centro"] = $pt->centro()->first()->razonsocial;
					$salida[] = $p;
				}
			}	
			return Response::json(array(
				'error' => false,
				'listado' => $salida),
				200
		    	);
		}catch (Exception $e){
			return Response::json(array('error'=>true,'mensaje'=>$e->getMessage()?:'No se encuentra el recurso:'.$id),200);
		}
	}
}
