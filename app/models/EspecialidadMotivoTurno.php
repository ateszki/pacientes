<?php

class EspecialidadMotivoTurno extends Maestro {

	protected $table = 'especialidad_motivo_turno'; 	

	protected $fillable = array(
		'especialidad_id',
		'motivo_turno_id',
		);


	public $rules = array(
                        'especialidad_id' => 'Required|integer|exists:especialidades,id',
                        'motivo_turno_id' => 'Required|integer|exists:motivos_turnos,id',
                );

	public function especialidades(){
		return $this->hasMany('Especialidad');
	} 
	public function prepagas(){
		return $this->hasMany('MotivoTurno');
	}

	public function vistaDetallada($especialidad_id){
		return DB::table('especialidad_motivo_turno')
                     ->join('especialidades','especialidad_motivo_turno.especialidad_id','=','especialidades.id')
		     ->join('motivos_turnos','especialidad_motivo_turno.motivo_turno_id','=','motivos_turnos.id')
			->select(DB::raw("especialidad_motivo_turno.id,especialidad_motivo_turno.especialidad_id,especialidades.especialidad,especialidad_motivo_turno.motivo_turno_id,motivos_turnos.motivo,motivos_turnos.general,motivos_turnos.requiere_pieza,motivos_turnos.requiere_derivador"))
                     ->where('especialidades.id','=',$especialidad_id)
			->get();
	}
}
