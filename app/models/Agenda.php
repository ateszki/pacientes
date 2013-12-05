<?php

class Agenda extends Maestro {

	protected $table = 'agendas'; 	

	protected $fillable = array(
		'centro_odontologo_especialidad_id',
		'fecha',
		'odontologo_efector_id',
		'habilitado_turnos',
		'observaciones',
		);


	public $rules = array(
                        'centro_odontologo_especialidad_id' => 'Required|exists:centros_odontologos_especialidades,id',
			'fecha' => 'Required|date',
			'odontologo_efector_id' => 'Required|exists:odontologos,id',
			'habilitado_turnos' => 'Required|integer|in:1,0',
			'observaciones' => 'Max:250',
                );

	public function turnos(){
		return $this->hasMany('Turno');
	}
	public function centroOdontologoEspecialidad(){
		return $this->belongsTo('CentroOdontologoEspecialidad');
	}

	
}
