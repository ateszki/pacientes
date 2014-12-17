<?php

class AnamnesisPregunta extends Maestro {

	protected $table = 'anamnesis_preguntas'; 	

	protected $fillable = array(
		'numero',
		'pregunta',
		);


	public $rules = array(
                        'numero' => 'Required|Max:10',
			'pregunta' => 'required|max:255',
                );

	public function respuestas(){
		return $this->hasMany('AnamnesisRespuesta','anamnesis_pregunta_id');
	}

	
}
