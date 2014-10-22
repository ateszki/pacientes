<?php

class GroupRole extends Maestro {

	protected $table = 'group_role'; 	

	protected $fillable = array(
		'group_id',
		'role_id',
		);

	protected $hidden = array('pivot');

	public $rules = array(
                        'group_id' => 'Required|integer|exists:groups,id',
                        'role_id' => 'Required|integer|exists:roles,id',
                );

	public function group(){
		return $this->belongsTo('Group');
	} 
	public function role(){
		return $this->belongsTo('Role');
	}

}
