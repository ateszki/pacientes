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
		);


	public $rules = array(
                        'razonsocial' => 'Required|Min:3|Max:100',
                );


	
}
