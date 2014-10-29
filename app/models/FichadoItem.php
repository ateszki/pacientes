<?php

class FichadoItem extends Maestro {

	protected $table = 'fichados_items'; 	

	protected $fillable = array(
			'fichado_id',
			'referencia_fichado_id',
			'tipo_referencia',
			'pieza_dental_id',
			'caras',
	);


	public $rules = array(
			'fichado_id' => 'required|integer|exists:fichados,id',
			'referencia_fichado_id' => 'required|integer|exists:referencias_fichados,id',
			'tipo_referencia'=>'required|max:1',
			'pieza_dental_id' => 'integer|exists:piezas_dentales,id',
			'caras'=>'max:5',
                );

	

	public function fichado(){
		return $this->belongsTo('Fichado');
	}
	public function referencia_fichado(){
		return $this->belongsTo('ReferenciaFichado');
	}
	public function pieza_dental(){
		return $this->belongsTo('PiezaDental');
	}
	
}
