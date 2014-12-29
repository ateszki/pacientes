<?php

class AuditoriaiController extends \BaseController {

	public function filtro01($tratamiento_id){
		try {
			$t = Tratamiento::findOrFail($tratamiento_id);
			
		} catch(\Exception $e){
			return Response::json(array(
			'error' => true,
			'mensaje' => $e->getMessage()),
			200
			);
		}
	}
}
