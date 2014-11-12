<?php

class OrdenTrabajoItem extends Maestro {

	protected $table = 'ordenes_trabajo_items'; 	

	protected $fillable = array(
			'orden_trabajo_id',
			'presupuesto_item_id',
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
			'presupuesto_item_id'=>'required|exists:presupuestos,id',
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

	public function orden_trabajo(){
		return $this->belongsTo('OrdenTrabajo');
	}

	public function presupuesto_item(){
		return $this->belongsTo('PresupuestoItem');
	}

	public function nomenclador_paso(){
		return $this->belongsTo('NomencladorPaso');
	}

	public function usuario_recibido(){
		return $this->belongsTo('User','user_id_recibido','id');
	}
	

	
	
}
