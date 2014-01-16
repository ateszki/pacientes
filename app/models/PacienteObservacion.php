<?php

class PacienteObservacion extends Maestro {

	protected $table = 'paciente_observaciones'; 	

	protected $fillable = array(
		'observacion',
		'paciente_id',
		'user_id',
		);


	public $rules = array(
			'paciente_id' => 'exists:pacientes,id',
			'user_id' => 'exists:users,id',
			'observacion' => 'required|min:2',
                );

	public function paciente(){
		return $this->belongsTo('Paciente');
	}
	
	public function user(){
		return $this->belongsTo('User');
	}
	

}
