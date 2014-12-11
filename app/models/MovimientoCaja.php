<?php

class MovimientoCaja extends Maestro {

	protected $table = 'movimientos_cajas'; 	

	protected $fillable = array(
			'caja_id',
			'user_id',
			'ingreso_egreso',
			'fecha',
			'hora',
			'importe',
			'ctacte_id',
			'observaciones',
			'caja_ref_id',
			'tipo_mov_caja_id',
			'medios_pago_caja_id',
		);


	public $rules = array(
			'caja_id' => 'required|integer|exists:cajas,id',
			'user_id' => 'required|integer|exists:users,id',
			'ingreso_egreso' => 'required|max:1|in:I,E',
			'fecha' => 'required|date',
			'hora' => 'required|date_format:H:i:s',
			'importe' => 'required|numeric',
			'ctacte_id' => 'integer|exists:ctactes,id',
			'observaciones' => 'max:255',
			'caja_ref_id' => 'integer|exists:cajas,id',
			'tipo_mov_caja_id' => 'required|integer|exists:tipo_mov_cajas,id',
			'medios_pago_caja_id' => 'required|integer|exists:medios_pago_caja,id',
                );
	
	protected $appends = array("nombre_caja","tipo_movimiento","medio_pago");

	public function caja(){
		return $this->belongsTo('Caja');	
	}
	public function usuario(){
		return $this->belongsTo('User');
	}
	public function recibo(){
		return $this->belongsTo('Ctacte');
	}
	public function caja_ref(){
		return $this->belongsTo('Caja','caja_ref_id');
	}
	public function tipo(){
		return $this->belongsTo('TipoMovCaja','tipo_mov_caja_id');
	}
	public function medio(){
		return $this->belongsTo('MedioPagoCaja','medios_pago_caja_id');
	}
	public function getNombreCajaAttribute(){
		return $this->caja()->first()->caja;
	}
	public function getTipoMovimientoAttribute(){
		return $this->tipo()->first()->tipo;
	}
	
	public function getMedioPagoAttribute(){
		return $this->medio()->first()->medio_pago_moneda;
	}
	public static function ingresoCtaCte($ctacte_id){
		DB::begintransaction();
		try {
			$CC = Ctacte::findOrFail($ctacte_id);
			$data = array(
				"caja_id" => $CC->caja_id,
				"importe" => 0,
				"ingreso_egreso" => "I",
				"fecha" => date("Y-m-d"),
				"hora" => date("H:i:s"),
				"user_id" => Auth::user()->id,
				"tipo_mov_caja_id" => 2, //ingreso por ctacte
				"medios_pago_caja_id" => NULL, 
				"ctacte_id" => $CC->id,
			);
			$lineas_rec = $CC->lineas_recibo()->get();
			//dd($lineas_rec->toArray());
			foreach ($lineas_rec as $pago){
				$MC = new MovimientoCaja();
				$data_pago = $data;
				$data_pago["importe"]= $pago->importe;
				$query = MedioPagoCaja::where('tipo','=',$pago->tipo);
				if($pago->tipo_cambio > 0){
					$query->where('moneda','=','DOL');
				} else {
					$query->where('moneda','=','ARS');
				}
				$MP = $query->first();
				$data_pago["medios_pago_caja_id"] = $MP->id;
				$MC->fill($data_pago);
				if (!$MC->save()){
					DB::rollback();
					return false;
				}
			}
			DB::commit();
			return true;
                } catch (Exception $e){
			DB::rollback();
                        return Response::json(array(
                        'error' => true,
                        'mensaje' => $e->getMessage()),
                        200
                        );
                }
	}
}
