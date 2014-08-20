<?php

class CtacteRecLin extends Maestro {

	protected $table = 'ctactes_rec_lin'; 	

	protected $fillable = array(
			'ctacte_id',
			'numero_cheque', 
			'codigo_banco', 
			'fecha_acreditacion', 
			'codigo_tarjeta', 
			'codigo_plan', 
			'numero_cupon', 
			'codigo_aprobacion', 
			'tipo_cambio',
			'importe',
			'tipo',
		);


	public $rules = array(
                        'ctacte_id' => 'Required|integer|exists:ctactes,id',
			'numero_cheque'=>'max:20', 
			'codigo_banco'=>'max:3|min:3', 
			'fecha_acreditacion'=>'date', 
			'codigo_tarjeta'=>'max:2', 
			'codigo_plan'=>'max:3', 
			'numero_cupon'=>'max:25', 
			'codigo_aprobacion'=>'max:25', 
			'tipo_cambio'=>'numeric',
			'importe'=>'numeric',
			'tipo' => 'Required|in:T,C,E,D',
                );

	public function ctacte(){
		return $this->belongsTo('Ctacte');
	}

}
