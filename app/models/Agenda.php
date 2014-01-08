<?php

class Agenda extends Maestro {

	protected $table = 'agendas'; 	

	protected $fillable = array(
		'centro_odontologo_especialidad_id',
		'fecha',
		'odontologo_efector_id',
		'habilitado_turnos',
		'observaciones',
		);

	public $rules = array(
                        'centro_odontologo_especialidad_id' => 'Required|exists:centros_odontologos_especialidades,id',
			'fecha' => 'Required|date',
			'odontologo_efector_id' => 'Required|exists:odontologos,id',
			'habilitado_turnos' => 'Required|integer|in:1,0',
			'observaciones' => 'Max:250',
                );

	public function turnos(){
		return $this->hasMany('Turno');
	}
	public function centroOdontologoEspecialidad(){
		return $this->belongsTo('CentroOdontologoEspecialidad');
	}

	
	public function vistaTurnos(){
		return DB::table('turnos')
                     ->leftJoin('paciente_prepaga','turno.paciente_prepaga_id','=','paciente_prepaga.id')
			->leftJoin('pacientes','paciente_prepaga.paciente_id','=','pacientes.id')
->leftJoin('prepagas','paciente_prepaga.prepaga_id','=','prepagas.id')
			->select(DB::raw("turnos.desde,turnos.hasta,turnos.estado,turnos.tipo,turnos.derivado_por,prepagas.codigo,pacientes.id,concat(pacientes.apellido,' ',pacientes.nombres) as nombre,pacientes.tipo_documento,pacientes.nro_documento"))
                     ->where('turnos.agenda_id', '=', $this->id)
                     ->get();
	}
}
