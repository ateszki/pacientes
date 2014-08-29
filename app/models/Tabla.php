<?php

class Tabla extends Maestro {

	protected $table = 'tablas'; 	

	protected $fillable = array(
		'codigo_tabla',
		'valor',
		'descripcion',
		'debehaber',
		);


	public $rules = array(
                        'codigo_tabla' => 'Required|max:50',
			'valor' =>'Required|max:100',
			'descripcion'=>'max:50',
			'debehaber'=>'min:1|max:1',
                );

	
}
