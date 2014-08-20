<?php

class CtacteFacLin extends Maestro {

	protected $table = 'ctactes_fac_lin'; 	

	protected $fillable = array(
			'ctacte_id',
			'item_id',
			'cantidad',
			'precio',
			'importe',
		);


	public $rules = array(
                        'ctacte_id' => 'Required|integer|exists:ctactes,id',
                        'item_id' => 'Required|integer',
			'cantidad' =>'Required|integer',
			'precio'=>'required|numeric',
			'importe'=>'required|numeric',

                );

	public function ctacte(){
		return $this->belongsTo('Ctacte');
	}

}
