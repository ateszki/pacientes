<?php

class Role extends Maestro {

	protected $table = 'roless'; 	

	protected $fillable = array(
		'role',
		);


	public $rules = array(
                        'role' => 'Required|Min:3|Max:250',
                );


	public function groups(){
		return $this->belongsToMany('Group');
	}
}
