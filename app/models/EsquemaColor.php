<?php

class EsquemaColor extends Maestro {

	protected $table = 'esquema_color'; 	

	protected $fillable = array(
		'nombre',
		'shape',
		'text_box',
		'list_view',
		);


	public $rules = array(
                        'nombre' => 'Required|Max:30',
                        'shape' => 'Required|Max:15',
                        'text_box' => 'Required|Max:15',
                        'list_view' => 'Required|Max:15',
                );


	
}
