<?php

class CtacteFacLin extends Maestro {

	protected $table = 'ctactes_fac_lin'; 	

	protected $fillable = array(
			'ctacte_id',
			'codigo',
			'descripcion',
			'cantidad',
			'precio',
			'importe',
			'tipo',
			'presupuesto_id',
			'tasa_iva',
			'importe_iva',
			'piezas_dentales_id',
			'caras',
		);


	public $rules = array(
                        'ctacte_id' => 'Required|integer|exists:ctactes,id',
                        'codigo' => 'Required|max:20',
                        'descripcion' => 'Required|max:100',
			'cantidad' =>'Required|integer',
			'precio'=>'required|numeric',
			'importe'=>'required|numeric',
                        'tipo' => 'Required|in:P,I,N',
			'tasa_iva' => 'numeric',
			'importe_iva' => 'numeric',
			'presupuesto_id' => 'integer',
			'piezas_dentales_id' => 'integer',
			'caras'=>'max:5',
                );

	public function ctacte(){
		return $this->belongsTo('Ctacte');
	}
	public function pieza_dental(){
		return $this->belongsTo('PiezaDental');
	}

}
