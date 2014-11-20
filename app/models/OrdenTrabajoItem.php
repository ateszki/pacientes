<?php

class OrdenTrabajoItem extends Maestro {

	protected $table = 'ordenes_trabajo_items'; 	

	protected $fillable = array(
			'orden_trabajo_id',
			'presupuesto_linea_id',
			'motivo',
			'nomenclador_paso_id',
			'autorizado_por',
			'tipo_cubeta',
			'fecha_devolucion',
			'user_id_recibido',
			'remito_devolucion',
			'estado_devolucion',
			'precio',
		);


	public $rules = array(
			'orden_trabajo_id'=>'required|exists:ordenes_trabajo,id',
			'presupuesto_linea_id'=>'required|exists:presupuestos_lineas,id',
			'motivo'=>'max:25',
			'nomenclador_paso_id'=>'required|exists:nomencladores_pasos,id',
			'autorizado_por'=>'max:25',
			'tipo_cubeta'=>'max:1',
			'fecha_devolucion'=>'date',
			'user_id_recibido'=>'exists:users,id',
			'remito_devolucion'=>'max:50',
			'estado_devolucion'=>'max:50',
			'precio'=>'numeric',
                );
	protected $appends = array('usuario_recibido_nombre','numero_pieza_dental','codigo_nomenclador','descripcion_nomenclador','codigo_nomenclador_paso','descripcion_nomenclador_paso');

	public function orden_trabajo(){
		return $this->belongsTo('OrdenTrabajo');
	}

	public function presupuesto_linea(){
		return $this->belongsTo('PresupuestoLinea','presupuesto_linea_id');
	}

	public function nomenclador_paso(){
		return $this->belongsTo('NomencladorPaso');
	}

	public function usuario_recibido(){
		return $this->belongsTo('User','user_id_recibido','id');
	}
	
	public function getNumeroPiezaDentalAttribute($value){
		return $this->presupuesto_linea()->first()->numero_pieza_dental;
	}
	
	public function getCodigoNomencladorAttribute($value){
		return $this->presupuesto_linea()->first()->codigo_nomenclador;
	}
	
	public function getCodigoNomencladorPasoAttribute($value){
		return $this->nomenclador_paso()->first()->nomenclador_paso()->first()->codigo;
	}
	
	public function getDescripcionNomencladorAttribute($value){
		return $this->presupuesto_linea()->first()->descripcion_nomenclador;
	}
	
	public function getDescripcionNomencladorPasoAttribute($value){
		return $this->nomenclador_paso()->first()->nomenclador_paso()->first()->descripcion;
	}
	
	public function getUsuarioRecibidoNombreAttribute($value){
		return (!empty($this->user_id_recibido))?$this->usuario_recibido()->first()->nombre:NULL;
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
		$esquema[] = array(
			      "Field"=> "codigo_nomenclador_paso",
				"Type"=> "varchar(8)",
			      "Null"=> "YES",
			      "Key"=> "",
			      "Default"=> null,
			      "Extra"=> ""
		);
		$esquema[] = array(
			      "Field"=> "descripcion_nomenclador_paso",
				"Type"=> "varchar(100)",
			      "Null"=> "YES",
			      "Key"=> "",
			      "Default"=> null,
			      "Extra"=> ""
		);
		$esquema[] = array(
			      "Field"=> "usuario_recibido_nombre",
				"Type"=> "varchar(100)",
			      "Null"=> "YES",
			      "Key"=> "",
			      "Default"=> null,
			      "Extra"=> ""
		);
		return $esquema;
	}
}
