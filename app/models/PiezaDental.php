<?php

class PiezaDental extends Maestro {

	protected $table = 'piezas_dentales'; 	

	protected $fillable = array(
		'diente',
		'descripcion',
		'sector',
		'permanente',
		);


	public $rules = array(
                        'diente' => 'Required|Min:2|Max:2',
			'descripcion' => 'max:100',
			'sector' => 'Required|integer',
			'premanente' =>'Required|boolean',
                );

	public function grupos(){
		return belongsToMany('GrupoDental');
	}
	
	public function esPermanente(){
		return ($this->permanente);
	}
	
}
