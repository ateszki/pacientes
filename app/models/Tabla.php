<?php

class Tabla extends Maestro {

	protected $table = 'tablas'; 	

	protected $fillable = array(
		'codigo_tabla',
		'valor',
		);


	public $rules = array(
                        'codigo_tabla' => 'Required|max:50',
			'valor' =>'Required|max:100',
                );

	
}
