<?php

class MotivoTurno extends Maestro {

	protected $table = 'motivos_turnos'; 	

	protected $fillable = array(
		'motivo',
		'general',
		'requiere_pieza',
		'requiere_derivador',
		);


	public $rules = array(
                        'motivo' => 'Required|Min:2',
			'general' =>'Required|boolean',
			'requiere_pieza' =>'Required|boolean',
			'requiere_derivador' =>'Required|boolean',
                );

	public function especialidades(){
		return $this->hasMany('Especialidad');
	}

	
}
