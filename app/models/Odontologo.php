<?php

class Odontologo extends Maestro {

	protected $table = 'odontologos'; 	

	protected $fillable = array(
		'nombres',
		'apellido',
		'matricula',
		'celular',
		'ciaseguropropio',
		'codigopostal',
		'cuit',
		'domicilio',
		'email',
		'fechaalta',
		'fechabaja',
		'iva_id',
		'localidad',
		'pais_id',
		'provincia_id',
		'seguropropio',
		'sexo',
		'telefono',
		'vtoseguropropio'
		);


	public $rules = array(
                        'nombres' => 'Required|Min:3|Max:50',
                        'apellido' => 'Required|Min:3|Max:50',
                        'matricula'     => 'Required|Max:10|Unique:odontologos',
                        'fechaalta' => 'Required|Date',
                        'sexo' => 'Required|In:M,F,m,f',
			'pais_id' => 'integer|exists:paises,id',
			'provincia_id' => 'integer|exists:provincias,id',
			'iva_id' => 'required|integer|exists:iva,id',
                );

	public function getNombreCompletoAttribute($value){
		return $this->apellido.", ".$this->nombres;
	}

	public function centrosEspecialidades(){
		return $this->hasMany('CentroOdontologoEspecialidad');
	}

	public function ausencias(){
		return $this->hasMany('AusenciaOdontologo');
	}

	public function existeAusencia($fecha){
		$au = $this->ausencias()->where('fecha_desde','<=',$fecha)->where('fecha_hasta','>=',$fecha)->get();
		return count($au);
	}

	public function vistaCentrosEspecialidades(){
		return DB::table('centros_odontologos_especialidades')
                     ->join('centros','centros_odontologos_especialidades.centro_id','=','centros.id')
->join('especialidades','centros_odontologos_especialidades.especialidad_id','=','especialidades.id')
			->select(DB::raw("centros_odontologos_especialidades.*,especialidades.especialidad, centros.razonsocial AS centro,
CASE centros_odontologos_especialidades.turno
WHEN 'T'
THEN 'Tarde'
WHEN 'M'
THEN 'Maniana'
END AS turno_nombre"))
                     ->where('odontologo_id', '=', $this->id)
                     ->get();
	}

}
