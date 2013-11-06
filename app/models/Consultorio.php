<?php

class Consultorio extends Maestro {

	protected $table = 'consultorios'; 	

	protected $fillable = array(
		'numero',
		'descripcion',
		'centro_id',
		);


	public $rules = array(
                        'numero' => 'Required|integer',
			'centro_id' => 'Required|integer'
                );


	
}
