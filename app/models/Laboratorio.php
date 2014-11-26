<?php

class Laboratorio extends Maestro {

	protected $table = 'laboratorios'; 	

	protected $fillable = array(
			'codigo',
			'razon_social',
			'cuit',
			'domicilio',
			'localidad',
			'provincia_id',
			'pais_id',
			'codigopostal',
			'telefono',
			'telefono2',
			'email',
			'iva_id',
			'fecha_baja',
			'observaciones',
		);


	public $rules = array(
			'codigo'=>'required|max:20',
			'razon_social'=>'required|max:50',
			'cuit'=>'max:11|min:11',
			'domicilio'=>'max:50',
			'localidad'=>'max:50',
			'codigopostal'=>'max:8',
			'telefono'=>'max:50',
			'telefono2'=>'max:50',
			'email'=>'email',
			'iva_id'=>'integer|exists:iva,id',
			'fecha_baja'=>'date',
			'pais_id' => 'integer|exists:paises,id',
			'provincia_id' => 'integer|exists:provincias,id',
                );
	public function precios(){
		return $this->hasMany('ListaPreciosLaboratorio');
	}
	
}
