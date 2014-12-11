<?php

class CierreCajaItem extends Maestro {

	protected $table = 'cierres_cajas_items'; 	

	protected $fillable = array(
		'cierres_cajas_id',
		'medios_pago_caja_id',
		'importe',
		);


	public $rules = array(
			'cierres_cajas_id' => 'required|integer|exists:cierres_cajas,id',
			'medios_pago_caja_id' => 'required|integer|exists:medios_pago_caja,id',
			'importe' => 'required|numeric',
                );

	public function cierre_caja(){
		return $this->belongsTo('CierreCaja');
	}
	
	public function medio_pago(){
		return $this->belongsTo('MedioPagoCaja');
	}
	
}
