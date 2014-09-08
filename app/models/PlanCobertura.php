<?php

class PlanCobertura extends Maestro {

	protected $table = 'planes_cobertura'; 	

	protected $fillable = array(		
			'codigo',
			'descripcion',
			'observaciones',
			'habilitado',
	);


	public $rules = array(
			'codigo'=>'required|max:20',
			'descripcion'=>'required|max:50',
			'habilitado'=>'boolean',

                );


	
}
