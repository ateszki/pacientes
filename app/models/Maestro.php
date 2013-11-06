<?php

class Maestro extends Eloquent {


	public $validator = NULL;	

	public $rules = array();


	public function isValid($id=null){

		$this->validator =  Validator::make($this->toArray(), $this->getValidationRules($id));
		return $this->validator->passes();
	}

/**
     * Get validation rules and take care of own id on update
     * @param int $id
     * @return array
     */
    public function getValidationRules($id=null)
    {
        $rules = $this->rules;
 
        if($id === null)
        {
            return $rules;
        }
 
        array_walk($rules, function(&$rules, $field) use ($id)
        {
            if(!is_array($rules))
            {
                $rules = explode("|", $rules);
            }
 
            foreach($rules as $ruleIdx => $rule)
            {
                // get name and parameters
                @list($name, $params) = explode(":", $rule);
 
                // only do someting for the unique rule
                if(strtolower($name) != "unique") {
                    continue; // continue in foreach loop, nothing left to do here
                }
 
                $p = array_map("trim", explode(",", $params));
 
                // set field name to rules key ($field) (laravel convention)
                if(!isset($p[1])) {
                    $p[1] = $field;
                }
 
                // set 3rd parameter to id given to getValidationRules()
                $p[2] = $id;
 
                $params = implode(",", $p);
                $rules[$ruleIdx] = $name.":".$params;
            }
        });
 
        return $rules;
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
            return $modelo->isValid($modelo->id);
        });
    }

    public  function getEsquema(){
	return DB::select('SHOW COLUMNS from `'.$this->table.'`');
	}
	
}
