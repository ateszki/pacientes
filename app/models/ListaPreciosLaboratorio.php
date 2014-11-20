<?php

class ListaPrecioLaboratorio extends Maestro {

	protected $table = 'listas_precios_laboratorio'; 	

	protected $fillable = array(
		'laboratorio_id',
		'nomenclador_id',
		'precio',
		);


	public $rules = array(
                        'laboratorio_id' => 'Required|integer|exists:laboratorio,id',
                        'nomenclador_id' => 'Required|integer|exists:nomencladores,id',
			'precio'=>'required|numeric',
	);

	public function laboratorio(){
		return $this->belongsTo('Laboratorio');
	} 
	public function nomenclador(){
		return $this->belongsTo('Nomenclador');
	}
}
