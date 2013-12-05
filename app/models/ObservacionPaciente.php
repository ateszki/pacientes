<?php

class ObservacionPaciente extends Maestro {

	protected $table = 'observaciones_pacientes'; 	

	protected $fillable = array(
		'tipo',
		'paciente_id',
		'user_id',
		'observacion',
		);


	public $rules = array(
			'tipo' => 'Required|exists:tipo_observaciones,id',
			'paciente_id' => 'Required|exists: pacientes,id',
			'user_id' => 'Required|integer',
                        'observacion' => 'Required|Max:250',
                );


	public function vistaDetallada($paciente_id){
		return DB::table('observaciones_pacientes')
                     ->join('pacientes','observaciones_pacientes.paciente_id','=','pacientes.id')
			->join('tipo_observaciones','observaciones_pacientes.tipo','=','tipo_observaciones.id')
			->select(DB::raw("observaciones_pacientes.*,concat(pacientes.nombres, ' ',pacientes.apellido) as pacientes,concat(pacientes.tipo_documento,' ',pacientes.nro_documento) as documento, tipo_observaciones.tipo  as tipo_nombre"))
                     ->where('pacientes.id','=',$paciente_id)
			->get();
	}
	
}
