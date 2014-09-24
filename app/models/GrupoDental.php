<?php

class GrupoDental extends Maestro {

	protected $table = 'grupos_dentales'; 	

	protected $fillable = array(
		'descripcion',
		);


	public $rules = array(
                        'descripcion' => 'Required|Max:100',
                );

	public function dientes(){
		return $this->belongstomany('PiezaDental');
	}
	
}
