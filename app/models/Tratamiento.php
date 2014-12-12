<?php

class Tratamiento  extends Maestro {

	protected $table = 'tratamientos'; 	

	protected $fillable = array(
		'turno_id',
		'nomenclador_id',
		'pieza_dental_id',
		'caras',
		'valor',
		'user_id_carga',
		'fecha_carga',
		'hora_carga',
		'resultado_auditoria',
		'fecha_auditoria',
		'user_id_auditor',
		);

	protected $appends = array('numero_pieza_dental','codigo_nomenclador','descripcion_nomenclador');

	public $rules = array(
			'turno_id' => 'required|integer|exists:turnos,id',
			'nomenclador_id' => 'required|integer|exists:nomencladores,id',
			'pieza_dental_id' => 'integer|exists:piezas_dentales,id',
			'caras' => 'max:5',
			'valor'=>'numeric',
			'user_id_carga' => 'required|integer|exists:users,id',
			'fecha_carga' =>'required|date',	
			'hora_carga' =>'date_format:H:i:s',	
			'resultado_auditoria' => 'max:1',
			'fecha_auditoria'=>'date',	
			'user_id_auditor' => 'integer|exists:users,id',
                );

	public function turno(){
		return $this->belongsTo('Turno');
	}

	public function nomenclador(){
		return $this->belongsTo('Nomenclador');
	}
	public function pieza_dental(){
		return ($this->pieza_dental_id !== null)?$this->belongsTo('PiezaDental','pieza_dental_id'):null;
	}
	
	public function getNumeroPiezaDentalAttribute(){
		return ($this->pieza_dental_id !== null)?$this->pieza_dental()->first()->diente:null;
	}
	public function getCodigoNomencladorAttribute(){
		return $this->nomenclador()->first()->codigo;
	}
	public function getDescripcionNomencladorAttribute(){
		return $this->nomenclador()->first()->descripcion;
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
