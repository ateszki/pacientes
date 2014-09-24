<?php

class GrupoDentalPiezaDental extends Maestro {

	protected $table = 'grupos_dentales_piezas_dentales'; 	

	protected $fillable = array(
		'grupos_dentales_id',
		'piezas_dentales_id',
		);


	public $rules = array(
			'grupos_dentales__id' => 'required|integer|exists:grupos_dentales,id',
			'piezas_dentales_id' => 'required|integer|exists:piezas_dentales,id',
                );

	public function diente(){
		return $this->hasOne('PiezaDental');
	}
	public function grupo(){
		return $this->hasOne('GrupoDental');
	}
}
