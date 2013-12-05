<?php

class Turno extends Maestro {

	protected $table = 'turnos'; 	

	protected $fillable = array(
		'agenda_id',
		'hora_desde',
		'hora_hasta',
		'tipo_turno',
		'estado',
		'prepaga_id',
		'motivo_turno_id',
		'piezas',
		'derivado_por',
		'observaciones',
		);


	public $rules = array(
                        'agenda_id' => 'Required|integer|exists:agendas,id',
			'hora_desde' => 'Required|min:4|max:4',
			'hora_hasta' => 'Required|min:4|max:4',
			'tipo_turno' => 'Required|min:1|max:1|in:T,E',//T = turno, E = entreturno
			'estado' => 'Required|min:1|max:1|in:A,B,L',//A = asignado, B = bloqueado, L = Libre
			'prepaga_id' => 'exists:prepagas',
			'motivo_turno_id' => 'integer',
			'piezas' => 'max:50',
			'derivado_por' => 'max:50',
			'observaciones' => 'max:250',
                );

	public function agenda(){
		return $this->belongsTo('Agenda');
	}

	
	public static function turnos_libres($especialidad_id,$parametros){
		$odontologos = (isset($parametros["odontologos"]) && !empty($parametros["odontologos"]))?$parametros["odontologos"]:NULL;
		$centros = (isset($parametros["centros"]) && !empty($parametros["centros"]))?$parametros["centros"]:NULL;
		$dias = (isset($parametros["dias"]) && !empty($parametros["dias"]))?$parametros["dias"]:NULL;
		$turnos = (isset($parametros["turnos"]) && !empty($parametros["turnos"]))?$parametros["turnos"]:NULL;
		
		$query = DB::table('turnos')
                     ->join('agendas','turnos.agenda_id','=','agenda.id')
			->join('centros_odontologos_especialidades','agendas.centro_odontologo_especialidad_id','=','centors_odontologos_especialidades.id')
			->join('especialidades','centros_odontologos_especialidades.especialidad_id','=','especialidades.id')
			->join('centros','centros_odontolgos_especialidades.centro_id','=','centros.id')
			->join('odontologos','centros_odontologos_especialidades.odontologos_id','=','odontologos.id')
			->select(DB::raw("agendas.*,turnos.*"))
			->select(DB::raw("agendas.*,turnos.*,especialidades.especialidad, centros.razonsocial AS centro,concat(odontologos.nombres, ' ',odontologos.apellido) as odontologo,odontologos.matricula,
				CASE centros_odontologos_especialidades.turno
				WHEN 'T'
				THEN 'Tarde'
				WHEN 'M'
				THEN 'Maniana'
				END AS turno_nombre"))
                     ->where('turnos.estado','=','L')
		     ->where('especialidad.id','=',$especialidad_id);
	
		if (!empty($odontologos)){$query->whereIn('odontologos.id',$odontologos);}
		if (!empty($centros)){$query->whereIn('centros.id',$centros);}
		if (!empty($dias)){$query->whereIn('centros_odontologos_especialidades.dia_semana',$dias);}
		if (!empty($turnos)){$query->whereIn('centros_odontologos_especialidades.turno',$turnos);}
	
		return $query->get();
	}
}
