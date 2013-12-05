<?php

class TipoObservaciones extends Maestro {

	protected $table = 'tipo_observaciones'; 	

	protected $fillable = array(
		'tipo',
		);


	public $rules = array(
                        'tipo' => 'Required|Max:250',
                );


	
}
