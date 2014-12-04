<?php

class PlanTratamiento extends Maestro {

	protected $table = 'planes_tratamientos'; 	

	protected $fillable = array(
		'paciente_id',
		'centro_odontologo_especialidad_id',
		'fecha',
		'diagnostico',
		);


	public $rules = array(
			'paciente_id' => 'required|integer|exists:pacientes,id',
			'centro_odontologo_especialidad_id' => 'integer|exists:centros_odontologogs_especialidades,id',
			'fecha' => 'required|date',
                );

	public function paciente(){
		return $this->belongsTo('Paciente');
	}
	
	public function centro_odontologo_especialidad(){
		return $this->belongsTo('CentroOdontologoEspecialidad');
	}

	public function derivaciones(){
		return $this->hasMany('PlanTratamientoDerivacion');
	}
	
	public function seguimiento(){
		return $this->hasMany('PlanTratamientoSeguimiento');
	}
	
}
