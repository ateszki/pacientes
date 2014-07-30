<?php

class MotivoTurno extends Maestro {

	protected $table = 'motivos_turnos'; 	

	protected $fillable = array(
		'motivo',
		);


	public $rules = array(
                        'motivo' => 'Required|Min:2',
                );

	public function especialidades(){
		return $this->hasMany('Especialidad');
	}

	
}
