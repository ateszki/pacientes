<?php

class FichadoItem extends Maestro {

	protected $table = 'fichados_items'; 	

	protected $appends = array('numero_pieza_dental','descripcion_referencia');
	
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
	
	public function getNumeroPiezaDentalAttribute($value){
		return (empty($this->pieza_dental_id))?NULL:$this->pieza_dental()->first()->diente;
	}

	public function getDescripcionReferenciaAttribute($value){
		return (empty($this->referencia_fichado_id))?NULL:$this->referencia_fichado()->first()->descripcion;
	}

	public function getEsquema(){
		$esquema = parent::getEsquema();
		$esquema[] = array(
			      "Field"=> "descripcion_referencia",
				"Type"=> "varchar(100)",
			      "Null"=> "YES",
			      "Key"=> "",
			      "Default"=> null,
			      "Extra"=> ""
		);
		$esquema[] = array(
			      "Field"=> "numero_pieza_dental",
				"Type"=> "varchar(2)",
			      "Null"=> "YES",
			      "Key"=> "",
			      "Default"=> null,
			      "Extra"=> ""
		);
		return $esquema;
	}
	
}
