<?php

class UserCentro extends Maestro {

	protected $table = 'users_centros'; 	

	protected $fillable = array(
		'user_id',
		'centro_id',
		);


	public $rules = array(
			'centro_id' => 'required|integer|exists:centros,id',
			'user_id' => 'required|integer|exists:users,id',
                );

	public function user(){
		return $this->belongsTo('User');
	}
	
	public function centro(){
		return $this->belongsTo('Centro');
	}
	
}
