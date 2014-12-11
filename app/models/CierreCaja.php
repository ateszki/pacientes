<?php

class CierreCaja extends Maestro {

	protected $table = 'cierres_cajas'; 	

	protected $fillable = array(
		'caja_id',
		'user_id',
		'fecha',
		'hora',
		);


	public $rules = array(
			'caja_id' => 'required|integer|exists:cajas,id',
			'user_id' => 'required|integer|exists:users,id',
			'fecha' => 'required|date',
			'hora' => 'required|date_format:H:i:s',
                );

	public function caja(){
		return $this->belongsTo('Caja');
	}
	
	public function user(){
		return $this->belongsTo('User');
	}

	public function items(){
		return $this->hasMany('CierreCajaItem','cierres_cajas_id');
	}	
}
