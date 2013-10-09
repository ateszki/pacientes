<?php

class Odontologo extends Eloquent {
	protected $table = 'odontologos'; 	
	
	public function validate($input) {

        $rules = array(
                'nombres' => 'Required|Min:3|Max:50',
                'apellidos' => 'Required|Min:3|Max:50',
                'matricula'     => 'Required|Max:10|Email',
                
        );

        return Validator::make($input, $rules);
}
	
}
