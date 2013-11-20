<?php

class Turno extends Maestro {

	protected $table = 'turnos'; 	

	protected $fillable = array(
		'agenda_id',
		'hora_desde',
		'hora_hasta',
		'tipo_turno',
		'estado',
		'prepaga_id',
		'motivo_turno_id',
		'piezas',
		'derivado_por',
		'observaciones',
		);


	public $rules = array(
                        'agenda_id' => 'Required|integer|exists:agendas',
			'hora_desde' => 'Required|min:4|max:4',
			'hora_hasta' => 'Required|min:4|max:4',
			'tipo_turno' => 'Required|min:1|max:1',
			'estado' => 'Required|min:1|max:1',
			'prepaga_id' => 'exists:prepagas',
			'motivo_turno_id' => 'integer',
			'piezas' => 'max:50',
			'derivado_por' => 'max:50',
			'observaciones' => 'max:250',
                );

	public function agenda(){
		return $this->belongsTo('Agenda');
	}

	
}
