<?php

class ListaPreciosNomenclador extends Maestro {

	protected $table = 'listas_precios_nomenclador'; 	

	protected $fillable = array(
		'listas_precios_id',
		'nomenclador_id',
		'precio',
		'requiere_autorizacion',
		'requiere_odontograma',
		'requiere_planilla_aparte',
		'observaciones',
		'precio_fuera_rango',
		'edad_coseguro_desde',
		'edad_coseguro_hasta',
		'grupos_dentales_id',
		'precio_fuera_cobertura',
		);


	public $rules = array(
                        'listas_precios_id' => 'Required|integer|exists:listas_precios,id',
                        'nomenclador_id' => 'Required|integer|exists:nomencladores,id',
			'precio'=>'required|numeric',
			'requiere_autorizacion'=>'required|boolean',
			'requiere_odontograma'=>'required|boolean',
			'requiere_planilla_aparte'=>'required|boolean',
			'precio_fuera_rango'=>'numeric',
			'edad_coseguro_desde'=>'integer|min:0|max:110',
			'edad_coseguro_hasta'=>'integer|min:0|max:110',
			'grupos_dentales_id'=>'integer|exists:grupos_dentales,id',
			'precio_fuera_cobertura'=>'numeric',
	);

	public function listas_precios(){
		return $this->belongsTo('ListaPrecios');
	} 
	public function nomenclador(){
		return $this->belongsTo('Nomenclador');
	}
	public function grupo_dental(){
		return $this->belongsTo("GrupoDental",'grupos_dentales_id','id');
	}
}
