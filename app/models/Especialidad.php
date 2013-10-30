<?php

class Especialidad extends Maestro {

	protected $table = 'especialidades'; 	

	protected $fillable = array(
		'especialidad',
		'lapso',
		'valor',
		);


	public $rules = array(
                        'especialidad' => 'Required|Max:50',
			'lapso' => 'Required|integer',
			'valor' => 'Required|integer',
                );


	
}
