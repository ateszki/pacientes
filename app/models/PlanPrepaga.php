<?php

class PlanPrepaga extends Maestro {

	protected $table = 'planes_prepaga'; 	

	protected $fillable = array(
		'prepaga_id',
		'plan_cobertura_id',
		'codigo',
		'descripcion',
		'lista_precios_id',
		'lista_basica_id',
		'requiere_bonos',
		'requiere_autorizacion',
		'requiere_odontograma',
		'requiere_planilla_aparte',
		'requiere_planilla_propia',
		'requiere_planilla_baja',
		'observaciones',
		'habilitado',
		);


	public $rules = array(
                        'prepaga_id' => 'Required|integer|exists:prepagas,id',
                        'plan_cobertura_id' => 'Required|integer|exists:planes_cobertura,id',
			'codigo' => 'required|max:20',
			'descripcion' =>'required|max:50',
			'lista_precios_id'=>'required|integer|exists:listas_precios,id',
			'lista_basica_id'=>'required|integer|exists:listas_precios,id',
			'requiere_bonos'=>'boolean',
			'requiere_autorizacion'=>'boolean',
			'requiere_odontograma'=>'boolean',
			'requiere_planilla_aparte'=>'boolean',
			'requiere_planilla_propia'=>'boolean',
			'requiere_planilla_baja'=>'boolean',
			'habilitado'=>'boolean',
	);

	public function plan_cobertura(){
		return $this->belongsTo('PlanesCobertura');
	} 
	public function prepagas(){
		return $this->hasMany('Prepaga');
	}

}
