<?php

class Centro extends Maestro {

	protected $table = 'centros'; 	

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
			'ctactes_id_factura'=>'required|exists:ctactes,id',
			'ctactes_id_recibo'=>'required|exists:ctactes,id',
                );

	public function laboratorio(){
		return $this->hasOne('Laboratorio');
	}
	public function presupuesto(){
		return $this->hasOne('Presupuesto');
	}
	public function usuario_emision(){
		return $this->hasOne('User','id','user_id_emision');
	}
	public function factura(){
		return $this->hasOne('Ctactes','id','ctactes_id_factura');
	}
	public function recibo(){
		return $this->hasOne('Ctactes','id','ctactes_id_recibo');
	}
	public function items(){
		return $this->hasMany('OrdenTrabajoItem');
	}

}
