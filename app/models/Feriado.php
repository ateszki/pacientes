<?php

class Feriado extends Maestro {

	protected $table = 'feriados'; 	

	protected $fillable = array(
		'fecha',
		'feriado',
		);


	public $rules = array(
                        'fecha' => 'Required|date',
			'feriado' =>'Required',
                );

	
}
