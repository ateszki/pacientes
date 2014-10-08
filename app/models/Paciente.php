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
			'iva_id' => 'Required|integer|exists:iva,id',
			'cuit' => 'max:11',
			'domicilio' => 'max:50',
			'localidad' => 'max:50',
			'provincia_id'=>'required|integer|exists:provincias,id',
			'pais_id'=>'required|integer|exists:paises,id',
                );

	public function prepagas(){
		return $this->belongsToMany('Prepaga');
	}

	public function observaciones(){
		return $this->hasMany('PacienteObservacion');
	}	
	
	public function presupuestos(){
		return $this->hasManyThrough('Presupuesto','PacientePrepaga');
	}

}
