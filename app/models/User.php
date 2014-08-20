<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {


	protected $table = 'users'; 	

	protected $fillable = array(
		'nombre',
		'email',
		'username',
		'password',
		'session_key',
		'session_expira',
		);


	public $rules = array(
		'nombre'=>'Required',
		'email'=>'required|email',
		'username'=>'required|max:50|unique:users',
		'password'=>'required',
		'session_key'=>'max:20',
		'session_expira'=>'date',
                );

/**
         * The attributes excluded from the model's JSON form.
         *
         * @var array
         */
        protected $hidden = array('password');
	protected $primaryKey = 'id';
        /**
         * Get the unique identifier for the user.
         *
         * @return mixed
         */
        public function getAuthIdentifier()
        {
                return $this->getKey();
        }

        /**
         * Get the password for the user.
         *
         * @return string
         */
        public function getAuthPassword()
        {
                return $this->password;
        }

        /**
         * Get the e-mail address where password reminders are sent.
         *
         * @return string
         */
        public function getReminderEmail()
        {
                return $this->email;
        }

	public function createSessionKey(){
		$session_key = substr(Hash::make(date('YmdHis').$this->username),-20);
		$session_expira = date('Y-m-d H:i:s',strtotime("+2 hours"));
		$data = array("session_key"=>$session_key,"session_expira"=>$session_expira);
		$this->update($data);
		return $data;
	}
	public function turnos(){
		return $this->hasMany('Turno');
	}

	public function pacienteObservaciones(){
		return $this->hasMany('PacienteObservacion');
	}

	public function groups(){
		return $this->belongsToMany('Group');
	}


			public function getRememberToken()
			{
			    return $this->remember_token;
			}

			public function setRememberToken($value)
			{
			    $this->remember_token = $value;
			}

			public function getRememberTokenName()
			{
			    return 'remember_token';
			}
}
