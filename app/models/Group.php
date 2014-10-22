<?php

class Group extends Maestro {

	protected $table = 'groups'; 	

	protected $fillable = array(
		'grupo',
		);
	protected $hidden = array('pivot');

	public $rules = array(
                        'grupo' => 'Required|Min:3|Max:250',
                );


	public function users(){
		return $this->belongsToMany('User');
	}
	
	public function roles(){
		return $this->belongsToMany('Role');
	}
}
