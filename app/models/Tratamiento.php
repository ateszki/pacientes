<?php

class Tratamiento  extends Maestro {

	protected $table = 'tratamientos'; 	

	protected $fillable = array(
		'turno_id',
		'nomenclador_id',
		'pieza_dental_id',
		'caras',
		'valor',
		'user_id_carga',
		'fecha_carga',
		'resultado_auditoria',
		'fecha_auditoria',
		'user_id_auditor',
		);


	public $rules = array(
			'turno_id' => 'required|integer|exists:turnos,id',
			'nomenclador_id' => 'required|integer|exists:nomencladores,id',
			'pieza_dental_id' => 'required|integer|exists:piezas_dentales,id',
			'caras' => 'max:5',
			'valor'=>'numeric',
			'user_id_carga' => 'required|integer|exists:users,id',
			'fecha_carga' =>'required|date',	
			'resultado_auditoria' => 'max:1',
			'fecha_auditoria'=>'date',	
			'user_id_auditor' => 'integer|exists:users,id',
                );

	public function turno(){
		return $this->belongsTo('Turno');
	}

	public function nomenclador(){
		return $this->belongsTo('Nomenclador');
	}
	
}
