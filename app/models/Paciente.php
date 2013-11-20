<?php

class Paciente extends Maestro {

	protected $table = 'pacientes'; 	

	protected $fillable = array(
		'apellido',
		'nombres',
		'fecha_nacimiento',
		'tipo_documento',
		'nro_documento',
		'sexo',
		'pais_nacimiento_id',
		'iva_id',
		'cuit',
		'domicilio',
		'localidad',
		'provincia_id',
		'pais_id',
		'codigopostal',
		'telefono',
		'telefono2',
		'celular',
		'email',
		);


	public $rules = array(
                        'nombres' => 'Required|Min:3|Max:50',
                        'apellido' => 'Required|Min:3|Max:50',
                        'fecha_nacimiento'     => 'Date',
                        'tipo_documento' => 'Required|In:CI,DU,LE,LC,PS',
			'nro_documento' => 'Required|integer',
                        'sexo' => 'Required|In:M,F,m,f',
			'iva_id' => 'Required|integer',
			'cuit' => 'max:11',
			'domicilio' => 'max:50',
			'localidad' => 'max:50',
			'provincia_id'=>'required|integer',
			'pais_id'=>'required|integer',
                );

	public function prepagas(){
		return $this->belongsToMany('Prepaga');
	}
	
}
