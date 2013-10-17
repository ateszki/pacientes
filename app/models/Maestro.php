<?php

class Maestro extends Eloquent {


	public $validator = NULL;	

	public $rules = array();


	public function isValid() {

		$this->validator =  Validator::make($this->toArray(), $this->rules);
		return $this->validator->passes();
	}

    public static function boot()
    {
        parent::boot();

        static::creating(function($modelo)
        {
            return $modelo->isValid();
        });
 
        static::updating(function($modelo)
        {
            return $modelo->isValid();
        });
    }

    public  function getEsquema(){
	return DB::select('SHOW COLUMNS from `'.$this->table.'`');
	}
	
}
