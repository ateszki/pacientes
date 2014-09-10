<?php

class PlanCoberturaEspecialidad extends Maestro {

	protected $table = 'planes_cobertura_especialidad'; 	

	protected $fillable = array(
		'planes_cobertura_id',
		'especialidad_id',
		);


	public $rules = array(
                        'planes_cobertura_id' => 'Required|integer|exists:planes_cobertura,id',
                        'especialidad_id' => 'Required|integer|exists:especialidades,id',
                );

	public function planes_cobertura(){
		return $this->hasMany('PlanesCobertura');
	} 
	public function especialidades(){
		return $this->hasMany('Especialidades');
	}

}
