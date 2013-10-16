<?php

class Odontologo extends Eloquent {

	protected $table = 'odontologos'; 	

	protected $fillable = array(
		'nombres',
		'apellido',
		'matricula',
		'celular',
		'ciaseguropropio',
		'codigopostal',
		'cuit',
		'domicilio',
		'email',
		'fechaalta',
		'fechabaja',
		'iva_id',
		'localidad',
		'pais_id',
		'provincia_id',
		'seguropropio',
		'sexo',
		'telefono',
		'vtoseguropropio'
		);

	public $validator = NULL;	

	public $rules = array(
                        'nombres' => 'Required|Min:3|Max:50',
                        'apellido' => 'Required|Min:3|Max:50',
                        'matricula'     => 'Required|Max:10|Unique:odontologos',

                );


	public function isValid() {
		/*if(!$this->changed('matricula')){
			$unique_matricula = 'Unique:odontologos,matricula,'.$this->id;
		} else {
			$unique_matricula = 'Unique:odontologos';
		}*/	


		$this->validator =  Validator::make($this->toArray(), $this->rules);
		return $this->validator->passes();
	}

    public static function boot()
    {
        parent::boot();

        static::creating(function($odontologo)
        {
            return $odontologo->isValid();
        });
 
        static::updating(function($odontologo)
        {
            return $odontologo->isValid();
        });
    }
	
}
