<?php

class Evento extends Eloquent {

	protected $table = 'eventos'; 	

	protected $fillable = array(
		'modelo_id',
		'modelo',
		'tabla',
		'query',
		'user_id',
		'usuario',
		);

/*
	public $rules = array(
		'modelo_id' => 'Required',
		'modelo' => 'Required',
		'tabla' => 'Required',
		'query' => 'Required',
		'user_id' => 'Required',
		'usuario' => 'Required',
                );

*/
	
}
