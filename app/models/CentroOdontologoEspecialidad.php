<?php

class CentroOdontologoEspecialidad extends Maestro {

	protected $table = 'centros_odontologos_especialidades'; 	

	protected $fillable = array(
		'centro_id',
		'odontologo_id',
		'especialidad_id',
		'dia_semana',
		'turno',
		'consultorio_id',
		'horario_desde',
		'horario_hasta',
		'duracion_turno',
		'cant_max_entreturnos',
		'habilitado',
		'observaciones',
		'entreturnos_desde',
		'entreturnos_hasta',
		);


	public $rules = array(
                        'centro_id' => 'Required|integer|exists:centros,id',
                        'odontologo_id' => 'Required|integer|exists:odontologos,id',
                        'especialidad_id' => 'Required|integer|exists:especialidades,id',
			'dia_semana' => 'Required|in:Lunes,Martes,Miercoles,Jueves,Viernes,Sabado,Domingo',
			'turno' => 'Required|in:T,M,N',
                );

	public function odontologo(){
		return $this->belongsTo('Odontologo');
	} 
	public function especialidad(){
		return $this->belongsTo('Especialidad');
	}
	public function centro(){
		return $this->belongsTo('Centro');
	}
	public function agendas(){
		return $this->hasMany('Agenda');
	}
	public function vistaDetalladaOdontologosAlta(){
		return DB::table('centros_odontologos_especialidades')
                     ->join('centros','centros_odontologos_especialidades.centro_id','=','centros.id')
		     ->join('especialidades','centros_odontologos_especialidades.especialidad_id','=','especialidades.id')
		     ->join('odontologos','centros_odontologos_especialidades.odontologo_id','=','odontologos.id')
			->select(DB::raw("centros_odontologos_especialidades.*,especialidades.especialidad, centros.razonsocial AS centro,centros.identificador,concat(odontologos.apellido, ' ',odontologos.nombres) as odontologo,odontologos.matricula,
CASE centros_odontologos_especialidades.turno
WHEN 'T'
THEN 'Tarde'
WHEN 'M'
THEN 'Maniana'
END AS turno_nombre"))
                     ->whereNull('odontologos.fechabaja')
                     ->get();
	}

	public function existeAgenda($fecha){
		$agenda = Agenda::where('centro_odontologo_especialidad_id','=',$this->id)->where('fecha','=',$fecha)->get()->toArray();
		return count($agenda);
	}
}
