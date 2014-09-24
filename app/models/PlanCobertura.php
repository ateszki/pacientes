<?php

class PlanCobertura extends Maestro {

	protected $table = 'planes_cobertura'; 	
	

	protected $fillable = array(		
			'codigo',
			'descripcion',
			'observaciones',
			'habilitado',
	);


	public $rules = array(
			'codigo'=>'required|max:20',
			'descripcion'=>'required|max:50',
			'habilitado'=>'boolean',

                );

	public function especialidades(){
		//return $this->hasManyThrough('Especialidad','PlanCoberturaEspecialidad','planes_cobertura_id','id');
		return $this->belongsToMany('Especialidad','planes_cobertura_especialidad','planes_cobertura_id','especialidad_id');
	}
	
	public function vista_especialidades(){
		$espe = $this->especialidades()->get();
		foreach ($espe as $k => $e){
			$espe[$k]['codigo'] = $this->codigo;
			unset($espe[$k]['pivot']);
		}
		return $espe;
	}
	
}
