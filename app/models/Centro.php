<?php

class Centro extends Maestro {

	protected $table = 'centros'; 	

	protected $fillable = array(
		'razonsocial',
		'telefono',
		'celular',
		'codigopostal',
		'domicilio',
		'localidad',
		'pais_id',
		'provincia_id',
		'identificador'
		);


	public $rules = array(
                        'razonsocial' => 'Required|Min:3|Max:100',
			'pais_id' => 'integer|exists:paises,id',
			'provincia_id' => 'integer|exists:provincias,id',
			'identificador' => 'required|max:1',
                );


	
}
