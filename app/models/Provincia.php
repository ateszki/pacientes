<?php

class Provincia extends Maestro {

	protected $table = 'provincias'; 	

	protected $fillable = array(
		'pais_id',
		'provincia',
		);


	public $rules = array(
                        'pais_id' => 'Required|Integer|Exists:paises,id',
			'provincia' => 'Required|Min:3',
                );

	public function pais(){
		return $this->belongsTo('Pais');
	}


	
}
