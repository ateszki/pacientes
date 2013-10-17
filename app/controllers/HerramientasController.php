<?php

class HerramientasController extends \BaseController {

	public static function getEsquema($modelo){
		$classname = $modelo;
		$m = new $classname();
			 return Response::json(array(
                        'error'=>false,
			'esquema'=>$m->getEsquema(),
                        ),200);

	}

	public static function getErrores($validator){
			$messages = $validator->messages()->toArray();
			$errormessages = array("error"=>"");
			foreach ($messages as $v){
				if(is_array($v)){$errormessages["error"] .= " | ".implode(',',$v);} else {$errormessages["error"] .= " | ".$v;}
			}
			if(strlen($errormessages["error"])){$errormessages["error"] = substr($errormessages["error"],3);}
                        return array($errormessages);
	}
}
