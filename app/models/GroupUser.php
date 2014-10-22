<?php

class GroupUser extends Maestro {

	protected $table = 'group_user'; 	

	protected $hidden = array('pivot');
	
	protected $fillable = array(
		'group_id',
		'user_id',
		);


	public $rules = array(
                        'group_id' => 'Required|integer|exists:groups,id',
                        'user_id' => 'Required|integer|exists:users,id',
                );

	public function group(){
		return $this->belongsTo('Group');
	} 
	public function user(){
		return $this->belongsTo('User');
	}

}
