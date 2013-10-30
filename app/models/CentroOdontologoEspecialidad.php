<?php

class CentroOdontologoEspecialidad extends Maestro {

	protected $table = 'centros_odontologos_especialidades'; 	

	protected $fillable = array(
		'centro_id',
		'odontologo_id',
		'especialidad_id',
		);


	public $rules = array(
                        'centro_id' => 'Required|integer|exists:centros,id',
                        'odontologo_id' => 'Required|integer|exists:odontologos,id',
                        'especialidad_id' => 'Required|integer|exists:especialidades,id',
                );


	
}
