<?php

class ErrorAuditoria extends Maestro {

	protected $table = 'errores_auditoria'; 	

	protected $fillable = array(
		'tratamiento_id',
		'codigo_errores_auditoria_id',
		);


	public $rules = array(
			'tratamiento_id' => 'required|integer|exists:tratamientos,id',
			'codigo_errores_auditoria_id' => 'required|integer|exists:codigo_errores_auditoria,id',
                );

	public function tratamiento(){
		return $this->belongsTo('Tratamiento');
	}
	
	public function codigo_errores_auditoria(){
		return $this->belongsTo('CodigoErroresAuditoria','codigo_errores_auditoria_id');
	}
	
}
