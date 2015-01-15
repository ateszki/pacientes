<?php

class PlanTratamientoSeguimiento extends Maestro {

	protected $table = 'planes_tratamiento_seguimiento'; 	

	protected $fillable = array(
		'planes_tratamiento_id',
		'fecha',
		'centro_odontologo_especialidad_id',
		'observaciones',
		);


	public $rules = array(
			'planes_tratamiento_id' => 'required|integer|exists:planes_tratamiento,id',
			'fecha'=>'required|date',
			'centro_odontologo_especialidad_id' => 'required|integer|exists:centros_odontologos_especialidades,id',
                );

	protected $appends = array('odontologo','especialidad');

	public function plan_tratamiento(){
		return $this->belongsTo('PlanTratamiento');
	}
	public function coe(){
		return $this->belongsTo('CentroOdontologoEspecialidad','centro_odontologo_especialidad_id');
	}
        public function getOdontologoAttribute(){
                return $this->coe()->first()->odontologo()->first()->nombre_completo;
        }
        public function getEspecialidadAttribute(){
                return $this->coe()->first()->especialidad()->first()->especialidad;
        }
        public function getEsquema(){
                $esquema = parent::getEsquema();
                $esquema[] = array(
                        "Field"=> "odontologo",
                        "Type"=> "varchar(60)",
                        "Null"=> "NO",
                        "Key"=> "",
                        "Default"=> "",
                        "Extra"=> ""
                        );
                $esquema[] = array(
                        "Field"=> "especialidad",
                        "Type"=> "varchar(60)",
                        "Null"=> "NO",
                        "Key"=> "",
                        "Default"=> "",
                        "Extra"=> ""
                        );
                return $esquema;
        }

	
}
