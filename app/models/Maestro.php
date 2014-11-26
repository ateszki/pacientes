<?php

class Maestro extends Eloquent {


	public $validator = NULL;	

	public $rules = array();

    // Override the parent method
    public function newCollection(array $models = Array())
    {
        return new Extensions\CustomCollection($models);
    }

	public function toArrayFechas()
	{
	     $array = parent::toArray();
	     $esquema = $this->getEsquema();
	     foreach ($esquema as $col)
		{
		    if(strtolower(substr($col->Type,0,4)) == 'date'){
			$array[$col->Field] = date('d/m/Y',strtotime($this->{$col->Field}));   
		    }
		}
	     return $array;
	}
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
/*
	static::saved(function($modelo){
		$queries = DB::getQueryLog();
		$last_query = end($queries);
		$c = array();
		$q =explode("?", $last_query["query"]);
		$b = $last_query["bindings"];
		for($i = 0;$i<count($b);$i++){
			$c[] = $q[$i].$b[$i];
		}
		$last_query = implode(" ",$c);
		$valores = array();
			$valores[] = $modelo->id;
			$valores[] = get_class($modelo);
			$valores[] = $modelo->getTable();
			$valores[] = $last_query;
			$valores[] = Auth::user()->id;
			$valores[] = Auth::user()->nombre;
			$valores[] = date("Y-m-d H:i:s");
			$valores[] = date("Y-m-d H:i:s");
		return DB::insert('INSERT INTO `eventos`(`modelo_id`, `modelo`, `tabla`, `query`, `user_id`, `usuario`, `created_at`, `updated_at`) values (?, ?, ?, ?, ?, ?, ?, ?)', $valores);

		$evento = new Evento();
		if(!strpos($last_query,"insert into `eventos`")){
			$evento->modelo_id = $modelo->id;
			$evento->modelo = get_class($modelo);
			$evento->tabla = $modelo->getTable();
			$evento->query = $last_query;
			$evento->user_id = Auth::user()->id;
			$evento->usuario = Auth::user()->nombre;
			$evento->save();
		}
	});*/
    }

    public  function getEsquema(){
	return DB::select('SHOW COLUMNS from `'.$this->table.'`');
	}

   public function getFechaArgAttribute($value){
		return (isset($this->fecha) && !empty($this->fecha) )?implode("/",array_reverse(explode("-",substr($this->fecha,0,10)))):false;
   }
	protected $appends = array('fecha_arg');	
}
