<?php

class PacientePrepaga extends Maestro {

	protected $table = 'paciente_prepaga'; 	

	protected $fillable = array(
		'paciente_id',
		'prepaga_id',
		'numero_credencial',
		'planes_prepaga_id',
		'fecha_alta',
		'fecha_baja',
		);


	public $rules = array(
                        'paciente_id' => 'Required|integer|exists:pacientes,id',
                        'prepaga_id' => 'Required|integer|exists:prepagas,id',
                        'numero_credencial' => 'Required|max:30',
			'planes_prepaga_id' => 'Required|integer|exists:planes_prepaga,id',
			'fecha_alta' => 'Required|date',
			'fecha_baja' => 'date',
                );

	public function paciente(){
		return $this->belongsTo('Paciente');
	} 
	public function prepaga(){
		return $this->belongsTo('Prepaga');
	}

	public function ctactes(){
		return $this->hasMany('Ctacte');
	}
	public function vistaDetallada($paciente_id){
		return DB::table('paciente_prepaga')
                     ->join('pacientes','paciente_prepaga.paciente_id','=','pacientes.id')
		     ->join('prepagas','paciente_prepaga.prepaga_id','=','prepagas.id')
		->join('planes_prepaga','paciente_prepaga.planes_prepaga_id','=','planes_prepaga.id')
			->select(DB::raw("paciente_prepaga.id,paciente_prepaga.planes_prepaga_id,paciente_prepaga.prepaga_id,paciente_prepaga.paciente_id,paciente_prepaga.numero_credencial,planes_prepaga.codigo as plan_cobertura,DATE_FORMAT(paciente_prepaga.fecha_baja,'%d/%m/%Y') AS fecha_baja,DATE_FORMAT(paciente_prepaga.fecha_alta,'%d/%m/%Y') AS fecha_alta,concat(pacientes.nombres, ' ',pacientes.apellido) as pacientes,concat(pacientes.tipo_documento,' ',pacientes.nro_documento) as documento, prepagas.codigo,prepagas.razon_social,prepagas.denominacion_comercial"))
                     ->where('pacientes.id','=',$paciente_id)
			->get();
	}
	public function turnos(){
		return $this->hasMany('Turno');
	}
}
