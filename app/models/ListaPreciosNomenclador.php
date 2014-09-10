<?php

class ListaPreciosNomenclador extends Maestro {

	protected $table = 'listas_precios_nomenclador'; 	

	protected $fillable = array(
		'lista_precio_id',
		'nomenclador_id',
		"precio",
		"requiere_autorizacion",
		"requiere_odontograma",
		"requiere_planilla_aparte",
		"observaciones",
		);


	public $rules = array(
                        'lista_precio_id' => 'Required|integer|exists:listas_precios,id',
                        'nomenclador_id' => 'Required|integer|exists:nomencladores,id',
			"precio"=>'numeric',
			"requiere_autorizacion"=>'boolean',
			"requiere_odontograma"=>'boolean',
			"requiere_planilla_aparte"=>'boolean',
	);

	public function lista_precios(){
		return $this->belongsTo('ListaPrecios');
	} 
	public function nomenclador(){
		return $this->hasMany('Nomenclador');
	}

}
