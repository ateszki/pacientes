<?php

class Evento extends Eloquent {

	protected $table = 'eventos'; 	

	protected $fillable = array(
		'modelo_id',
		'modelo',
		'tabla',
		'query',
		'user_id',
		'usuario',
		);

	protected $appends = array('accion');
/*
	public $rules = array(
		'modelo_id' => 'Required',
		'modelo' => 'Required',
		'tabla' => 'Required',
		'query' => 'Required',
		'user_id' => 'Required',
		'usuario' => 'Required',
                );

*/
	public function getAccionAttribute(){
		if(strtolower(substr($this->query,0,3)) == 'ins'){ 
			return	"crear";
		} elseif(strtolower(substr($this->query,0,3)) == 'del'){ 
			return	"eliminar";
		} elseif(strtolower(substr($this->query,0,3)) == 'ins'){ 
			return	"actualizar";
		} else {
			return "otro";
		}
	}	
}
