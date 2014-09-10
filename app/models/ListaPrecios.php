<?php

class ListaPrecios extends Maestro {

	protected $table = 'listas_precios'; 	

	protected $fillable = array(
		'codigo',
		'observaciones',
		'habilitado',
		);


	public $rules = array(
			'codigo' => 'required|max:20',
			'habilitado'=>'boolean',
	);


}
