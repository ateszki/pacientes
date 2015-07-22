<?php

class AuditoriaController extends \BaseController {

	public $errores =[];
	
	public function auditar($tratamiento_id){
		try {
			$t = Tratamiento::findOrFail($tratamiento_id);
			$tu = $t->turno;
			$p = PacientePrepaga::findOrFail($tu->paciente_prepaga_id)->paciente;
			$o = Odontologo::findOrFail($tu->agenda->odontologo_efector_id);
			$n = $t->nomenclador;
			$this->errores[$t->id]=[];
			$this->edadFueraDeRango($t,$p,$n,$tu);
			return Response::json(array(
			'error' => false,
			'listado' => array("tratamiento"=>$t->toArray(),"errores"=>$this->errores[$t->id])),
			200
			);
			
		} catch(\Exception $e){
			return Response::json(array(
			'error' => true,
			'mensaje' => $e->getMessage()),
			200
			);
		}
	}

	private function difFechas($desde,$hasta,$unidad='d'){
		return date_diff(date_create($desde), date_create($hasta))->$unidad;
	}

	private function edadFueraDeRango($t,$p,$n,$tu){
		try {
			$edad = $this->difFechas($p->fecha_nacimiento,$tu->fecha,'y');
			$desde= $n->edad_desde;
			$hasta = $n->edad_hasta;
			if($edad < $desde || $edad > $hasta){
				$this->errores[$t->id][]='02';
			} 
			return true;
			
		} catch(\Exception $e){
			return Response::json(array(
			'error' => true,
			'mensaje' => $e->getMessage()),
			200
			);
		}
	}
}
