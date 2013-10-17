<?php

class Odontologo extends Maestro {

	protected $table = 'odontologos'; 	

	protected $fillable = array(
		'nombres',
		'apellido',
		'matricula',
		'celular',
		'ciaseguropropio',
		'codigopostal',
		'cuit',
		'domicilio',
		'email',
		'fechaalta',
		'fechabaja',
		'iva_id',
		'localidad',
		'pais_id',
		'provincia_id',
		'seguropropio',
		'sexo',
		'telefono',
		'vtoseguropropio'
		);


	public $rules = array(
                        'nombres' => 'Required|Min:3|Max:50',
                        'apellido' => 'Required|Min:3|Max:50',
                        'matricula'     => 'Required|Max:10|Unique:odontologos',
                        'fechaalta' => 'Required|Date',
                        'sexo' => 'Required|In:M,F,m,f',

                );
}
