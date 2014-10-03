<?php

class PresupuestoLinea extends Maestro {

	protected $table = 'presupuestos_lineas'; 	

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
			'alternativa' => 'required|integer'
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
	
}
