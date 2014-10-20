<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Maestro implements UserInterface, RemindableInterface {


	protected $table = 'users'; 	

	protected $fillable = array(
		'nombre',
		'email',
		'username',
		'password',
		'session_key',
		'session_expira',
		'es_admin',
		'habilitado',
		);


	public $rules = array(
		'nombre'=>'Required',
		'email'=>'required|email',
		'username'=>'required|max:50|unique:users',
		'session_key'=>'max:20',
		'session_expira'=>'date',
		'es_admin'=>'required|boolean',
		'habilitado'=>'required|boolean',
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
		$u = User::where('id','=',$this->id)->first();
		$u->fill($data);
		$u->save();

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

	    public function roles()
	    {
		/*$salida = array();
		$grupos = $this->groups()->get();
		foreach ($grupos as $g){
			$roles = $g->roles()->get();
			foreach($roles as $r){
				$salida[$r->id] = $r;
			}
		}*/
		return Role::whereIn('id',function($query){$query->select('role_id')->from('group_role')->whereIn('group_id',function($query1){$query1->select('group_id')->from('group_user')->where('user_id','=',$this->id);});});
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

		public function getEsquema(){
			$esquema = parent::getEsquema();
			$esquema1 = array_filter($esquema,function($e){
				return ($e->Field != 'password');
			});
			return array($esquema1);
		}

		public function setPassword($p){
			$pass = Hash::make($p);
			$this->password = $pass;
			return $this->save();
		}


}
