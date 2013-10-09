<?php

class CentroOdontologoEspecialidad extends Eloquent {
	protected $table = 'centros_odontologos_especialidades'; 	
	
	public function odontologo()
    {
        return $this->belongsTo('Odontologo');
    }
	
	public function especialidad()
    {
        return $this->belongsTo('Especialidad');
    }

	public function centro()
    {
        return $this->belongsTo('Centro');
    }
	
	
}
