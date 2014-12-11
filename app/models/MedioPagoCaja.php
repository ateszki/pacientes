<?php

class MedioPagoCaja extends Maestro {

	protected $table = 'medios_pago_caja'; 	

	protected $appends = array("medio_pago_moneda");

	protected $fillable = array(
			'medio_pago',
			'moneda',
		);


	public $rules = array(
                        'medio_pago' => 'Required|Max:255',
			'moneda' => 'required|in:ARS,DOL,EUR'
                );


	
	public function getMedioPagoMonedaAttribute(){
		return $this->medio_pago." (".$this->moneda.")";
	}
}
