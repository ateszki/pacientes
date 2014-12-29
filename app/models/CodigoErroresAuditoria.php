<?php

class CodigoErroresAuditoria extends Maestro {

	protected $table = 'codigo_errores_auditoria'; 	

	protected $fillable = array(
		'codigo',
		'descripcion',
		);


	public $rules = array(
                        'codigo' => 'Required|Max:2',
			'descripcion' => 'Required|max:255',
                );

	public function errores_auditoria(){
		return $this->hasMany('ErrorAuditoria','codigo_errores_auditoria_id');
	}
	
}
