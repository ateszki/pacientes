<?php

class Pais extends Maestro {

	protected $table = 'paises'; 	

	protected $fillable = array(
		'pais',
		);


	public $rules = array(
                        'pais' => 'Required|Min:3',
                );

	public function provincias(){
		return $this->hasMany('Provincia');
	}
	
}
