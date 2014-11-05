<?php

class Fichado extends Maestro {

	protected $table = 'fichados'; 	

//	protected $appends = array('nombre_odontologo');

	protected $fillable = array(
			'fecha_emision',
			'fecha_auditoria',
			'tipo_fichado',
			'paciente_id',
			'centro_odontologo_especialidad_id',
			'user_id_emision',
	);


	public $rules = array(
                        'fecha_emision' => 'Required|date',
                        'fecha_auditoria' => 'Required|date',
			'tipo_fichado'=>'required|max:1',
			'paciente_id' => 'required|integer|exists:pacientes,id',
			'centro_odontologo_especialidad_id' => 'required|integer|exists:centros_odontologos_especialidades,id',
			'user_id_emision' => 'required|integer|exists:users,id',
                );



	public function paciente(){
		return $this->belongsTo('Paciente');
	}
	public function centro_odontologo_especialidad(){
		return $this->belongsTo('CentroOdontologoEspecialidad');
	}
	public function usuario_emision(){
		return $this->belongsTo('User','user_id_emision');
	}
	public function items(){
		return $this->hasMany('FichadoItem');
	}
	
	public function centroOdontologoEspecialidad(){
		return $this->belongsTo('CentroOdontologoEspecialidad');
	}

}
