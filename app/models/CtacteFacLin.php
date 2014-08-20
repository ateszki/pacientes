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
			'tipo'
		);


	public $rules = array(
                        'ctacte_id' => 'Required|integer|exists:ctactes,id',
                        'codigo' => 'Required|max:20',
                        'descripcion' => 'Required|max:100',
			'cantidad' =>'Required|integer',
			'precio'=>'required|numeric',
			'importe'=>'required|numeric',
                        'tipo' => 'Required|in:P,I,N',

                );

	public function ctacte(){
		return $this->belongsTo('Ctacte');
	}

}
