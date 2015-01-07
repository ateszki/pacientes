<?php

class TrazasController extends \BaseController {


	public function traza($modelo,$id){
		try {
			//$traza  = DB::table('eventos')->where('modelo_id','=',$id)->where('modelo','=',$modelo)->get();
			$traza  = Evento::where('modelo_id','=',$id)->where('modelo','=',$modelo)->get();
				return Response::json(array(
					'error' => false,
					'listado' => $traza),
					200
				);
			
		} catch (Exception $e){
			return Response::json(array(
			'error' => true,
			'mensaje' => $e->getMessage()),
			200
			);
		}
	}
}
