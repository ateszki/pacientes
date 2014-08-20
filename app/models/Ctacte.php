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
			'presupuesto_id',
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
		);


	public $rules = array(
                        'paciente_prepaga_id' => 'Required|integer|exists:paciente_prepaga,id',
                        'centro_odontologo_especialidad_id' => 'Required|integer|exists:centros_odontologos_especialidades,id',
			'user_id' =>'Required|integer|exists:users,id',
			'tipo_movimiento'=>'Required|min:2|max:2',
			'tipo_cbte' => 'Required|min:2|max:2',
			'prefijo_cbte' => 'Required|min:4|max:4',
			'nro_cbte' => 'Required|min:8|max:8',
			'fecha'=>'Required|date',
			'importe_bruto'=>'required|numeric',
			'importe_neto'=>'required|numeric',
			'importe_iva'=>'required|numeric',
			'print_ok'=>'Required|boolean',				

                );

	public function lineas_factura(){
		return $this->hasMany('CtacteFacLin');
	}
	public function lineas_recibo(){
		return $this->hasMany('CtacteRecLin');
	}

}
