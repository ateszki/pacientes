<?php

class Role extends Maestro {

	protected $table = 'roles'; 	

	protected $fillable = array(
		'role',
		'observaciones',
		);


	protected $hidden = array('pivot');

	public $rules = array(
                        'role' => 'Required|Min:3|Max:250',
			'observaciones'=>'max:255',
                );


	public function groups(){
		return $this->belongsToMany('Group');
	}
}
