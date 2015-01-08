<?php

class PlanTratamiento extends Maestro {

	protected $table = 'planes_tratamiento'; 	

	protected $fillable = array(
		'paciente_id',
		'centro_odontologo_especialidad_id',
		'fecha',
		'diagnostico',
		);


	public $rules = array(
			'paciente_id' => 'required|integer|exists:pacientes,id',
			'centro_odontologo_especialidad_id' => 'integer|exists:centros_odontologos_especialidades,id',
			'fecha' => 'required|date',
                );

	public function paciente(){
		return $this->belongsTo('Paciente');
	}
	
	public function centro_odontologo_especialidad(){
		return ($this->centro_odontologo_especialidad_id != null)?$this->belongsTo('CentroOdontologoEspecialidad'):NULL;
	}

	public function derivaciones(){
		return $this->hasMany('PlanTratamientoDerivacion','planes_tratamiento_id');
	}
	
	public function seguimiento(){
		return $this->hasMany('PlanTratamientoSeguimiento','planes_tratamiento_id');
	}

	public function odontologo(){
		return ($this->centro_odontologo_especialidad() != NULL)?$this->centro_odontologo_especialidad()->first()->odontologo():NULL;
	}	
	public function especialidad(){
		return $this->centro_odontologo_especialidad()->first()->especialidad();
	}	
	public function centro(){
		return $this->centro_odontologo_especialidad()->first()->centro();
	}	
	public function getEsquema(){
		$esquema = parent::getEsquema();
		$esquema[] = array(
			      "Field"=> "odontologo",
				"Type"=> "varchar(255)",
			      "Null"=> "YES",
			      "Key"=> "",
			      "Default"=> null,
			      "Extra"=> ""
		);
		$esquema[] = array(
			      "Field"=> "especialidad",
				"Type"=> "varchar(255)",
			      "Null"=> "YES",
			      "Key"=> "",
			      "Default"=> null,
			      "Extra"=> ""
		);
		$esquema[] = array(
			      "Field"=> "centro",
				"Type"=> "varchar(255)",
			      "Null"=> "YES",
			      "Key"=> "",
			      "Default"=> null,
			      "Extra"=> ""
		);
		return $esquema;
	}
}
