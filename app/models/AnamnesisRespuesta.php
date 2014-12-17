<?php

class AnamnesisRespuesta extends Maestro {

	protected $table = 'anamnesis_respuestas'; 	

	protected $fillable = array(
		'paciente_id',
		'anamnesis_pregunta_id',
		'respuesta',
		);


	public $rules = array(
			'paciente_id' => 'required|integer|exists:pacientes,id',
			'anamnesis_pregunta_id' => 'requiredinteger|exists:anamnesis_preguntas,id',
                        'respuesta' => 'Max:512',
                );

	public function paciente(){
		return $this->belongsTo('Paciente');
	}

	public function pregunta(){
		return $this->belongsTo('AnamnesisPregunta','anamnesis_pregunta_id');
	}
	
}
