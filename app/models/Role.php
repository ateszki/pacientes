<?php

class Group extends Maestro {

	protected $table = 'groups'; 	

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
