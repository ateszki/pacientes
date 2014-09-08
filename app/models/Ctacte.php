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
			'importe_total',
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
			'importe_total'=>'required|numeric',
			'print_ok'=>'Required|boolean',				
			'cancelado'=>'boolean',				

                );

    public static function boot()
    {
        parent::boot();

        static::deleting(function($ctacte)
        {   
            // Delete all tricks that belong to this user
            foreach ($ctacte->lineas_factura()->get() as $lf) {
                $lf->delete();
            }
            foreach ($ctacte->lineas_recibo()->get() as $lr) {
                $lr->delete();
            }
        });

        // Setup event bindings...
    }

	public function lineas_factura(){
		return $this->hasMany('CtacteFacLin');
	}
	public function lineas_recibo(){
		return $this->hasMany('CtacteRecLin');
	}

	public function paciente_prepaga(){
		return $this->belongsTo('PacientePrepaga');
	}
	public function aplicado_a(){
		return $this->belongsTo('Ctacte','referencia');
	}
	public function comprobantes_aplicados(){
		return $this->hasMany('Ctacte','referencia');
	}
/*	
	public function getImporteAttribute($value){
		return $this->importe_neto+$this->importe_iva;
	}
*/
	public function getDebeAttribute($value){
		$t = Tabla::where('codigo_tabla','=','COMPROBANTES_CTACTE')->where('valor','=',$this->tipo_prev)->first();
		return (is_object($t))?($t->debehaber == 'D')?$this->importe_total:0:0;
	}
	public function getHaberAttribute($value){
		$t = Tabla::where('codigo_tabla','=','COMPROBANTES_CTACTE')->where('valor','=',$this->tipo_prev)->first();
		return (is_object($t))?($t->debehaber == 'H')?$this->importe_total:0:0;
	}
	public function getSaldoAttribute($value){
		$importe_aplicado = DB::table('ctactes')->where('referencia','=',$this->id)->where('cancelado','=',0)->sum('importe_bruto');
		return $this->importe_bruto - $importe_aplicado;
	}
	protected $appends = array("fecha_arg","debe","haber","saldo");
}
