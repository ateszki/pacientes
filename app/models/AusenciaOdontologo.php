<?php

class AusenciaOdontologo extends Maestro {

	protected $table = 'ausencias_odontologos'; 	

	protected $fillable = array(
		'odontologo_id',
		'fecha_desde',
		'fecha_hasta',
		'motivo',
		);


	public $rules = array(
                        'motivo' => 'Required|Max:100',
			'fecha_desde' => 'Required|date',
			'fecha_hasta' => 'Required|date',
			'odontologo_id' => 'Required|exists:odontologos,id',
                );

	public function odontolgo(){
		return $this->belongsTo('Odontologo');
	}
	
}
