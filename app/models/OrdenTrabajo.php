<?php

class OrdenTrabajo extends Maestro {

	protected $table = 'ordenes_trabajo'; 	

	protected $fillable = array(
			'laboratorio_id',
			'presupuesto_id',
			'fecha_emision',
			'fecha_espera',
			'user_id_emision',
			'centro_odontologo_especialidad_id',
			'observaciones',
			'ctactes_id_factura',
			'ctactes_id_recibo',
		);


	public $rules = array(
			'laboratorio_id'=>'required|exists:laboratorios,id',
			'presupuesto_id'=>'required|exists:presupuestos,id',
			'fecha_emision'=>'required|date',
			'fecha_espera'=>'date',
			'user_id_emision'=>'required|exists:users,id',
			'centro_odontologo_especialidad_id'=>'required|exists:centros_odontologos_especialidades,id',
			'ctactes_id_factura'=>'exists:ctactes,id',
			'ctactes_id_recibo'=>'exists:ctactes,id',
                );

	protected $appends = array('nombre_laboratorio','codigo_laboratorio');
	protected $hidden =array('laboratorio');

	public function laboratorio(){
		return $this->belongsTo('Laboratorio');
	}
	public function presupuesto(){
		return $this->belongsTo('Presupuesto');
	}
	public function usuario_emision(){
		return $this->belongsTo('User','id','user_id_emision');
	}
	public function factura(){
		return $this->belongsTo('Ctactes','id','ctactes_id_factura');
	}
	public function recibo(){
		return $this->belongsTo('Ctactes','id','ctactes_id_recibo');
	}
	public function items(){
		return $this->hasMany('OrdenTrabajoItem');
	}
	public function getNombreLaboratorioAttribute($value){
		return $this->laboratorio->razon_social;
	}
	public function getCodigoLaboratorioAttribute($value){
		return $this->laboratorio->codigo;
	}
}
