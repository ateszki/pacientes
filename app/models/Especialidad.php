<?php

class Especialidad extends Maestro {

	protected $table = 'especialidades'; 	

	protected $fillable = array(
		'especialidad',
		'lapso',
		'valor',
		'requiere_derivacion',
		);


	public $rules = array(
                        'especialidad' => 'Required|Max:50',
			'lapso' => 'Required|integer',
			'valor' => 'Required|integer',
			'requiere_derivacion' => 'Required|integer|in:0,1',
                );

	public function motivosTurnos(){
		return $this->hasMany('MotivoTurno');
	}

	
}
