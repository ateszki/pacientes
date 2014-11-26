<?php

class MedioPagoCaja extends Maestro {

	protected $table = 'medios_pago_caja'; 	

	protected $fillable = array(
			'medio_pago',
			'moneda',
		);


	public $rules = array(
                        'medio_pago' => 'Required|Max:255',
			'moneda' => 'required|in:ARS,DOL,EUR'
                );


	
}
