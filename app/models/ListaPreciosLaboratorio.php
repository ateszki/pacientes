<?php

class ListaPreciosLaboratorio extends Maestro {

	protected $table = 'listas_precios_laboratorio'; 	

	protected $fillable = array(
		'laboratorio_id',
		'nomenclador_paso_id',
		'precio',
		);

	protected $appends = array('codigo_nomenclador','descripcion_nomenclador','codigo_nomenclador_paso','descripcion_nomenclador_paso');
	
	public $rules = array(
                        'laboratorio_id' => 'Required|integer|exists:laboratorios,id',
                        'nomenclador_paso_id' => 'Required|integer|exists:nomencladores_pasos,id',
			'precio'=>'required|numeric',
	);

	public function laboratorio(){
		return $this->belongsTo('Laboratorio');
	} 
	public function nomenclador_paso(){
		return $this->belongsTo('NomencladorPaso');
	}
	public function getCodigoNomencladorAttribute($value){
		return $this->nomenclador_paso()->first()->nomenclador->codigo;
	}
	public function getDescripcionNomencladorAttribute($value){
		return $this->nomenclador_paso()->first()->nomenclador->descripcion;
	}
	public function getCodigoNomencladorPasoAttribute($value){
		return $this->nomenclador_paso()->first()->nomenclador_paso()->first()->codigo;
	}
	public function getDescripcionNomencladorPasoAttribute($value){
		return $this->nomenclador_paso()->first()->nomenclador_paso()->first()->descripcion;
	}
}
