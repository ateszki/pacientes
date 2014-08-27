<?php

class Ctacte extends Maestro {

	protected $table = 'ctactes'; 	

	protected $fillable = array(
			'paciente_prepaga_id',
			'tipo_movimiento',
			'tipo_cbte',
			'prefijo_cbte',
			'nro_cbte',
			'fecha',
			'referencia',
			'importe_bruto',
			'porc_bonificacion',
			'importe_neto',
			'importe_iva',
			'user_id',
			'centro_odontologo_especialidad_id',
			'fecha_transferencia_bas',
			'ticket',
			'fecha_ticket',
			'print_ok',
			'impresora_fiscal',
			'cancelado',
			'tipo_prev',
		);


	public $rules = array(
                        'paciente_prepaga_id' => 'Required|integer|exists:paciente_prepaga,id',
                        'centro_odontologo_especialidad_id' => 'Required|integer|exists:centros_odontologos_especialidades,id',
			'user_id' =>'Required|integer|exists:users,id',
			'tipo_movimiento'=>'Required|min:2|max:2',
			'tipo_prev' => 'Required|min:2|max:2',
			'tipo_cbte' => 'min:2|max:2',
			'prefijo_cbte' => 'max:4',
			'nro_cbte' => 'max:8',
			'fecha'=>'Required|date',
			'importe_bruto'=>'required|numeric',
			'importe_neto'=>'required|numeric',
			'importe_iva'=>'required|numeric',
			'print_ok'=>'Required|boolean',				
			'cancelado'=>'boolean',				

                );

	public function lineas_factura(){
		return $this->hasMany('CtacteFacLin');
	}
	public function lineas_recibo(){
		return $this->hasMany('CtacteRecLin');
	}

	public function paciente_prepaga(){
		return $this->belongsTo('PacientePrepaga');
	}
}
