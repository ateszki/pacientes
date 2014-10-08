<?php

class Presupuesto extends Maestro {

	protected $table = 'presupuestos'; 	

	protected $fillable = array(
			'fecha_emision',
			'user_id_emision',
			'fecha_aprobacion',
			'user_id_aprobacion',
			'centro_odontologo_especialidad_id',
			'bonificacion',
			'paciente_prepaga_id',
			'importe_bruto',
			'importe_neto',
			'observaciones'
	);


	public $rules = array(
                        'fecha_emision' => 'Required|date',
			'user_id_emision' => 'required|integer|exists:users,id',
			'fecha_aprobacion' => 'date',
			'user_id_aprobacion' => 'integer|exists:users,id',
			'centro_odontologo_especialidad_id' => 'integer|exists:centros_odontologos_especialidades,id',
			'bonificacion'=>'numeric',
			'paciente_prepaga_id' => 'integer|exists:paciente_prepaga,id',
			'importe_bruto'=>'numeric',
			'importe_neto'=>'numeric',
			'observaciones'=>'max:512',
                );

	public function pacientePrepaga(){
		return $this->belongsTo('PacientePrepaga');
	}
	public function centro_odontologo_especialidad(){
		return $this->belongsTo('CentroOdontologoEspecialidad');
	}
	public function usuario_emision(){
		return $this->belongsTo('User','user_id_emision');
	}
	public function usuario_aprobacion(){
		return $this->belongsTo('User','user_id_aprobacion');
	}
	public function lineas(){
		return $this->hasMany('PresupuestoLinea');
	}
	
	public function centroOdontologoEspecialidad(){
		return $this->belongsTo('CentroOdontologoEspecialidad');
	}
	
}
