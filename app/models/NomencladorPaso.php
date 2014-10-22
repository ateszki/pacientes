<?php

class NomencladorPaso extends Maestro {

	protected $table = 'nomencladores_pasos'; 	

	protected $fillable = array(
			'nomenclador_id',
			'nomenclador_paso_id',
			'numero_etapa',
		);


	public $rules = array(
                        'numero_etapa' => 'numeric',
			'nomenclador_id' => 'required|integer|exists:nomencladores,id',
			'nomenclador_paso_id' => 'required|integer|exists:nomencladores,id',
                );

	public function nomenclador(){
		return $this->hasOne('Nomenclador','id','nomenclador_id');
	}
	public function nomenclador_paso(){
		return $this->hasOne('Nomenclador','id','nomenclador_paso_id');
	}
	
}
