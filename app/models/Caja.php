<?php

class Caja extends Maestro {

	protected $table = 'caja'; 	

	protected $fillable = array(
			'caja',
			'descripcion',
			'controlador_fiscal',	
		);


	public $rules = array(
                        'caja' => 'Required|Max:100',
			'descripcion' => 'max:255',
			'controlador_fiscal' => 'max:25',
                );


	
}
