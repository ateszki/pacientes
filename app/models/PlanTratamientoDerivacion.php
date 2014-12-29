<?php

class PlanTratamientoDerivacion extends Maestro {

	protected $table = 'planes_tratamiento_derivaciones'; 	

	protected $fillable = array(
		'planes_tratamiento_id',
		'especialidad_id',
		'numero_orden',
		'centro_odontologo_especialidad_id',
		'observaciones_odontologo_quederiva',
		'observaciones_odontologo_queatiende',
		'estado_derivacion',
		);


	public $rules = array(
			'planes_tratamiento_id' => 'required|integer|exists:planes_tratamiento,id',
			'especialidad_id' => 'required|integer|exists:especialidades,id',
			'numero_orden'=>'required|integer',
			'centro_odontologo_especialidad_id' => 'integer|exists:centros_odontologos_especialidades,id',
			'estado_derivacion' => 'required|max:1',
                );

	protected $appends = array('especialidad','odontologo');
	public function plan_tratamiento(){
		return $this->belongsTo('PlanTratamiento');
	}
	public function especialidad(){
		return $this->belongsTo('Especialidad');
	}
	public function coe(){
		return $this->belongsTo('CentroOdontologoEspecialidad','centro_odontologo_especialidad_id');
	}

	public function getEspecialidadAttribute(){
		return $this->especialidad()->first()->especialidad;
	}

	public function getOdontologoAttribute(){
		//dd("bb",$this->centro_odontologo_especialidad_id !=NULL, $this->centro_odontologo_especialidad_id);
		//dd($this->coe() == NULL,$this->centro_odontologo_especialidad_id);
		//return ($this->centro_odontologo_especialidad_id != NULL)?$this->coe()->first()->odontologo()->first()->nombre_completo:null;
		
		return ($this->coe()->first() == NULL)?null:$this->coe()->first()->odontologo()->first()->nombre_completo;;
	}
	public function getEsquema(){
		$esquema = parent::getEsquema();
		$esquema[] = array(
			"Field"=> "especialidad",
			"Type"=> "varchar(60)",
			"Null"=> "NO",
			"Key"=> "",
			"Default"=> "",
			"Extra"=> ""
			);
		$esquema[] = array(
			"Field"=> "odontologo",
			"Type"=> "varchar(60)",
			"Null"=> "YES",
			"Key"=> "",
			"Default"=> NULL,
			"Extra"=> ""
			);
		return $esquema;
	}
}
