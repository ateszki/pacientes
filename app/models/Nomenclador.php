<?php

class Nomenclador extends Maestro {

	protected $table = 'nomencladores'; 	

	protected $fillable = array(
			'codigo',
			'descripcion',
			'edad_desde',
			'edad_hasta',
			'nivel_auditoria',
			'requiere_pieza',
			'requiere_cara',
			'requiere_sector',
			'requiere_pilar',
			'multiples_piezas',
			'duracion_estimada',
			'paso_intermedio',
			'genera_odontograma',
			'item_bas',
			'figura_odontograma',
			'imagen_odontograma_anterior',
			'imagen_odontograma_arealizar',
			'habilitado',  
		);


	public $rules = array(
			'codigo'=>'required|max:8',
			'descripcion'=>'required|max:50',
			'edad_desde'=>'integer',
			'edad_hasta'=>'integer',
			'nivel_auditoria'=>'max:1|min:1',
			'requiere_pieza'=>'boolean',
			'requiere_cara'=>'boolean',
			'requiere_sector'=>'boolean',
			'requiere_pilar'=>'boolean',
			'multiples_piezas'=>'boolean',
			'duracion_estimada'=>'integer',
			'paso_intermedio'=>'boolean',
			'genera_odontograma'=>'boolean',
			'item_bas'=>'max:15',
			'figura_odontograma'=>'boolean',
			'imagen_odontograma_anterior'=>'max:50',
			'imagen_odontograma_arealizar'=>'max:50',
			'habilitado'=>'boolean',  
                );

	public function tasa_iva(){
		if(!empty($this->item_bas)){
			$t = Tabla::where('codigo_tabla','=','ITEM_BAS')->where('valor','=',$this->item_bas)->firstOrFail();
			return $t->coeficiente;
		}else{
			return null;
		}
	}
	
}
