<?php

class MovimientoCaja extends Maestro {

	protected $table = 'movimientos_cajas'; 	

	protected $fillable = array(
			'caja_id',
			'user_id',
			'ingreso_egreso',
			'fecha',
			'hora',
			'importe',
			'ctacte_id',
			'observaciones',
			'caja_ref_id',
			'tipo_mov_caja_id',
			'medios_pago_caja_id',
		);


	public $rules = array(
			'caja_id' => 'required|integer|exists:cajas,id',
			'user_id' => 'required|integer|exists:users,id',
			'ingreso_egreso' => 'required|max:1|in:I,E',
			'fecha' => 'required|date',
			'hora' => 'required|date_format:H:i',
			'importe' => 'required|numeric',
			'ctacte_id' => 'integer|exists:ctactes,id',
			'observaciones' => 'max:255',
			'caja_ref_id' => 'integer|exists:cajas,id',
			'tipo_mov_caja_id' => 'required|integer|exists:tipo_mov_cajas,id',
			'medios_pago_caja_id' => 'required|integer|exists:medios_pago_caja,id',
                );

	public function caja(){
		return $this->belongsTo('Caja');	
	}
	public function usuario(){
		return $this->belongsTo('User');
	}
	public function recibo(){
		return $this->belongsTo('Ctacte');
	}
	public function caja_ref(){
		return $this->belongsTo('Caja','caja_ref_id');
	}
	public function tipo(){
		return $this->belongsTo('TipoMovCaja');
	}
}
