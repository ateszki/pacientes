<?php

class CentroOdontologoEspecialidad extends Maestro {

	protected $table = 'centros_odontologos_especialidades'; 	

	protected $fillable = array(
		'centro_id',
		'odontologo_id',
		'especialidad_id',
		'dia_semana',
		'turno',
		'consultorio_id',
		'horario_desde',
		'horario_hasta',
		'duracion_turno',
		'cant_max_entreturnos',
		'habilitado',
		);


	public $rules = array(
                        'centro_id' => 'Required|integer|exists:centros,id',
                        'odontologo_id' => 'Required|integer|exists:odontologos,id',
                        'especialidad_id' => 'Required|integer|exists:especialidades,id',
			'dia_semana' => 'Required|in:Lunes,Martes,Miercoles,Jueves,Viernes,Sabado,Domingo',
			'turno' => 'Required|in:T,M,N',
                );

public function odontologo(){
	return $this->belongsTo('Odontologo');
} 
public function especialidad(){
	return $this->belongsTo('Especialidad');
}
public function centro(){
	return $this->belongsTo('Centro');
}
}
