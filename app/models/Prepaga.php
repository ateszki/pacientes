<?php

class Prepaga extends Maestro {

	protected $table = 'prepagas'; 	

	protected $fillable = array(
		'codigo',
		'razon_social',
		'denominacion_omercial',
		'cuit',
		'domicilio',
		'localidad',
		'pais_id',
		'provincia_id',
		'codigopostal',
		'telefono',
		'telefono2',
		'email',
		'iva_id',
		'credencial_propia',
		'presenta_padron',
		'fecha_alta',
		'fecha_baja',
		'condicion_venta_id',
		'turnos_habilitados',
		'precios_bonificados',
		);


	public $rules = array(
			'codigo' => 'Required|max:5',
                        'razon_social' => 'Required|Max:50',
			'denominacion_comercial' => 'Required|max:50',
			'cuit' => 'min:11|max:11|integer',
			'domicilio' => 'max:50',
			'localidad' => 'max:50',
			'provincia_id' => 'integer',
			'pais_id' => 'integer',
			'codigopostal' => 'min:4|max:8',
			'telefono' => 'max:50',
			'telefono2' => 'max:50',
			'email' => 'max:254|email',
			'iva_id' => 'integer'
			'credencial_propia' => 'max:1',
			'presenta_padron' => 'max:1',
			'fecha_alta' => 'date',
			'fecha_baja' => 'date',
			'condicion_venta_id' => 'integer',
			'turnos_habilitados' => 'max:1'
			'precios_bonificados' => 'max:1'
                );


	
}
