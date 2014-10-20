<?php

class PresupuestoLinea extends Maestro {

	protected $table = 'presupuestos_lineas'; 	
	protected $appends = array('codigo_nomenclador','descripcion_nomenclador','numero_pieza_dental');

	protected $fillable = array(
			'presupuesto_id',
			'alternativa',
			'nomenclador_id',
			'pieza_dental_id',
			'caras',
			'aprobado',
			'importe',	
	);


	public $rules = array(
			'presupuesto_id' => 'required|integer|exists:presupuestos,id',
			'alternativa' => 'required|integer',
			'nomenclador_id' => 'required|integer|exists:nomencladores,id',
			'pieza_dental_id' => 'integer|exists:piezas_dentales,id',
			'caras'=>'max:5',
			'aprobado'=>'boolean',
			'importe'=>'required|numeric',
                );

	

	public function presupuesto(){
		return $this->belongsTo('Presupuesto');
	}
	public function nomenclador(){
		return $this->belongsTo('Nomenclador');
	}
	public function pieza_dental(){
		return $this->belongsTo('PiezaDental');
	}
	
	public function getCodigoNomencladorAttribute($value){
		return $this->nomenclador()->first()->codigo;
	}
	public function getDescripcionNomencladorAttribute($value){
		return $this->nomenclador()->first()->descripcion;
	}
	public function getNumeroPiezaDentalAttribute($value){
		return (empty($this->pieza_dental_id))?NULL:$this->pieza_dental()->first()->diente;
	}

	public function getEsquema(){
		$esquema = parent::getEsquema();
		$esquema[] = array(
			      "Field"=> "codigo_nomenclador",
				"Type"=> "varchar(8)",
			      "Null"=> "YES",
			      "Key"=> "",
			      "Default"=> null,
			      "Extra"=> ""
		);
		$esquema[] = array(
			      "Field"=> "descripcion_nomenclador",
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
