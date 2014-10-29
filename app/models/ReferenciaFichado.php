<?php

class ReferenciaFichado extends Maestro {

	protected $table = 'referencias_fichados'; 	

	protected $fillable = array(
			'descripcion',
			'requiere_pieza',
			'requiere_cara',
			'requiere_sector',
			'multiples_piezas',
			'imagen_odontograma_anterior',
			'imagen_odontograma_arealizar',
			'extension_imagen', 
	);


	public $rules = array(
			'descripcion'=>'required|max:50',
			'requiere_pieza'=>'required|boolean',
			'requiere_cara'=>'required|boolean',
			'requiere_sector'=>'required|boolean',
			'multiples_piezas'=>'required|boolean',
			'imagen_odontograma_anterior'=>'max:50',
			'imagen_odontograma_arealizar'=>'max:50',
			'extension_imagen'=>'required|max:3|min:3', 
                );

	

	
}
