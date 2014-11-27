<?php

class Caja extends Maestro {

	protected $table = 'cajas'; 	

	protected $fillable = array(
			'caja',
			'descripcion',
			'controlador_fiscal',	
			'centro_id',
			'punto_de_venta',
		);


	public $rules = array(
                        'caja' => 'Required|Max:100',
			'descripcion' => 'max:255',
			'controlador_fiscal' => 'max:25',
			'punto_de_venta'=>'max:4',
			'centro_id' => 'exists:centros,id',
                );

	public function centro(){
		return $this->belongsTo('Centro');
	}
	
}
