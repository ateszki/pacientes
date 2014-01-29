<?php

class Iva extends Maestro {

	protected $table = 'iva'; 	

	protected $fillable = array(
		'iva',
		);


	public $rules = array(
                        'iva' => 'Required|Min:2',
                );

}
