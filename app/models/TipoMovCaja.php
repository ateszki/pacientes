<?php

class TipoMovCaja extends Maestro {

	protected $table = 'tipo_mov_cajas'; 	

	protected $fillable = array(
			'tipo',
		);


	public $rules = array(
                        'tipo' => 'Required|Max:255',
                );


	
}
