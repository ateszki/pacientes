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
			->leftJoin('motivos_turnos','turnos.motivo_turno_id','=','motivos_turnos.id')
                     ->leftJoin('paciente_prepaga','turnos.paciente_prepaga_id','=','paciente_prepaga.id')
			->leftJoin('pacientes','paciente_prepaga.paciente_id','=','pacientes.id')
->leftJoin('prepagas','paciente_prepaga.prepaga_id','=','prepagas.id')
->leftJoin('agendas','turnos.agenda_id','=','agendas.id')
->leftJoin('centros_odontologos_especialidades','agendas.centro_odontologo_especialidad_id','=','centros_odontologos_especialidades.id')
			->select(DB::raw("turnos.id,turnos.presente,turnos.hora_desde,turnos.hora_hasta,turnos.estado,turnos.tipo_turno,turnos.derivado_por,turnos.piezas,motivos_turnos.motivo,turnos.observaciones,prepagas.codigo,pacientes.id as paciente_id,concat(pacientes.apellido,' ',pacientes.nombres) as nombre,pacientes.tipo_documento,pacientes.nro_documento,centros_odontologos_especialidades.cant_max_entreturnos,centros_odontologos_especialidades.entreturnos_desde,centros_odontologos_especialidades.entreturnos_hasta,centros_odontologos_especialidades.turno,agendas.id as agenda_id,prepagas.id as prepaga_id,turnos.fuera_de_agenda"))
                     ->where('turnos.agenda_id', '=', $this->id)
                     ->get();
	}


}

