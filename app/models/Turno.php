<?php

class Turno extends Maestro {

	protected $table = 'turnos'; 	

	protected $fillable = array(
		'agenda_id',
		'hora_desde',
		'hora_hasta',
		'tipo_turno',
		'estado',
		'paciente_prepaga_id',
		'motivo_turno_id',
		'piezas',
		'derivado_por',
		'observaciones',
		'user_id',
		'presente',
		'fuera_de_agenda',
		);


	public $rules = array(
                        'agenda_id' => 'Required|integer|exists:agendas,id',
			'hora_desde' => 'Required|min:4|max:4',
			'hora_hasta' => 'Required|min:4|max:4',
			'tipo_turno' => 'Required|min:1|max:1|in:T,E',//T = turno, E = entreturno
			'estado' => 'Required|min:1|max:1|in:A,B,L',//A = asignado, B = bloqueado, L = Libre
			'paciente_prepaga_id' => 'exists:paciente_prepaga,id',
			'motivo_turno_id' => 'integer|exists:motivos_turnos,id',
			'piezas' => 'max:50',
			'derivado_por' => 'max:50',
			'observaciones' => 'max:250',
			'user_id' => 'exists:users,id',
			'presente' =>'integer|in:0,1',
			'fuera_de_agenda'=>'boolean',
                );

	public function agenda(){
		return $this->belongsTo('Agenda');
	}
	
	public function usuario(){
		return $this->belongsTo('User');
	}
	
	public function motivo(){
		return $this->hasOne('Motivo');
	}

	public function tratamientos(){
		return $this->hasMany('Tratamiento');
	}

	public static function turnos_libres($especialidad_id,$parametros){
		$odontologos = (isset($parametros["odontologos"]) && !empty($parametros["odontologos"]))?$parametros["odontologos"]:NULL;
		$centros = (isset($parametros["centros"]) && !empty($parametros["centros"]))?$parametros["centros"]:NULL;
		$dias = (isset($parametros["dias"]) && !empty($parametros["dias"]))?$parametros["dias"]:NULL;
		$turnos = (isset($parametros["turnos"]) && !empty($parametros["turnos"]))?$parametros["turnos"]:NULL;
		
		$query = DB::table('turnos')
                     ->join('agendas','turnos.agenda_id','=','agendas.id')
			->join('centros_odontologos_especialidades','agendas.centro_odontologo_especialidad_id','=','centros_odontologos_especialidades.id')
			->join('especialidades','centros_odontologos_especialidades.especialidad_id','=','especialidades.id')
			->join('centros','centros_odontologos_especialidades.centro_id','=','centros.id')
			->join('odontologos','centros_odontologos_especialidades.odontologo_id','=','odontologos.id')
			->select(DB::raw("agendas.*,turnos.*"))
			->select(DB::raw("agendas.centro_odontologo_especialidad_id,centros_odontologos_especialidades.dia_semana,DATE_FORMAT(agendas.fecha,'%d/%m/%Y') as fecha,agendas.odontologo_efector_id,agendas.observaciones as agenda_observaciones,turnos.*,especialidades.id as especialidad_id, especialidades.especialidad, centros.id as centro_id, centros.razonsocial AS centro,odontologo_id as odontologo_id, concat(odontologos.nombres, ' ',odontologos.apellido) as odontologo,odontologos.matricula,
				CASE centros_odontologos_especialidades.turno
				WHEN 'T'
				THEN 'Tarde'
				WHEN 'M'
				THEN 'Maniana'
				END AS turno_nombre"))
			->where('agendas.fecha','>=',date('Y-m-d'))
                     ->where('turnos.estado','=','L')
		     ->where('especialidades.id','=',$especialidad_id);
	
		if (!empty($odontologos)){$query->whereIn('odontologos.id',$odontologos);}
		if (!empty($centros)){$query->whereIn('centros.id',$centros);}
		if (!empty($dias)){$query->whereIn('centros_odontologos_especialidades.dia_semana',$dias);}
		if (!empty($turnos)){$query->whereIn('centros_odontologos_especialidades.turno',$turnos);}
		$query->orderBy('agendas.fecha','asc');
		return $query->skip(0)->take(50)->get();
	}

}
