<?php

class PacientePrepaga extends Maestro {

	protected $table = 'paciente_prepaga'; 	

	protected $fillable = array(
		'paciente_id',
		'prepaga_id',
		'numero_credencial',
		'plan_cobertura',
		'fecha_alta',
		'fecha_baja',
		);


	public $rules = array(
                        'paciente_id' => 'Required|integer|exists:pacientes,id',
                        'prepaga_id' => 'Required|integer|exists:prepagas,id',
                        'numero_credencial' => 'Required|max:30',
			'plan_cobertura' => 'Required|max:30',
			'fecha_alta' => 'Required|date',
			'fecha_baja' => 'date',
                );

	public function pacientes(){
		return $this->hasMany('Pacientes');
	} 
	public function prepagas(){
		return $this->hasMany('Prepagas');
	}

	public function vistaDetallada($paciente_id){
		return DB::table('paciente_prepaga')
                     ->join('pacientes','paciente_prepaga.paciente_id','=','pacientes.id')
		     ->join('prepagas','paciente_prepaga.prepaga_id','=','prepagas.id')
			->select(DB::raw("paciente_prepaga.id,paciente_prepaga.prepaga_id,paciente_prepaga.paciente_id,paciente_prepaga.numero_credencial,paciente_prepaga.plan_cobertura,DATE_FORMAT(paciente_prepaga.fecha_baja,'%d/%m/%Y') AS fecha_baja,DATE_FORMAT(paciente_prepaga.fecha_alta,'%d/%m/%Y') AS fecha_alta,concat(pacientes.nombres, ' ',pacientes.apellido) as pacientes,concat(pacientes.tipo_documento,' ',pacientes.nro_documento) as documento, prepagas.codigo,prepagas.razon_social,prepagas.denominacion_comercial"))
                     ->where('pacientes.id','=',$paciente_id)
			->get();
	}
}
