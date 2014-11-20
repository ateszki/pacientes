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
		return $this->belongsTo('Nomenclador');
	}
	public function nomenclador_paso(){
		return $this->belongsTo('Nomenclador','nomenclador_paso_id');
	}
	
}
