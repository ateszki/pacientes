<?php

class UserController extends MaestroController {

	function __construct(){
		$this->classname= 'User';
		$this->modelo = new $this->classname();
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(){
		return parent::index();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return parent::store();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return parent::show($id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return parent::update($id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return parent::destroy($id);
	}

	public function validar(){
		$data = Input::All();
		unset($data["apikey"]);
		if( Auth::attempt($data)){
			$key = Auth::user()->createSessionKey();
			return Response::json(array('error'=>false,"listado"=>array('id'=>Auth::user()->id,'esquema_color_id'=>Auth::user()->esquema_color_id,'nombre'=>Auth::user()->nombre,'session_key'=>$key["session_key"],'session_expira'=>$key["session_expira"])),200);
		} else {
			return Response::json(array('error'=>true,'mensaje'=>"Usuario o clave incorrectos."),200);
		}
	}
	public function validarSimple(){
		$data = Input::All();
		unset($data["apikey"]);
		unset($data["session_key"]);
		if( Auth::attempt($data)){
			return Response::json(array('error'=>false,"listado"=>array('id'=>Auth::user()->id,'nombre'=>Auth::user()->nombre)),200);
		} else {
			return Response::json(array('error'=>true,'mensaje'=>"Usuario o clave incorrectos."),200);
		}
	}

	public function grupos($id){
		try {
			$u = $this->modelo->findOrfail($id);
			$grupos = $u->groups()->get();
			return Response::json(array('error'=>false,"listado"=>$grupos->toArray()),200);
		} catch(\Exception $e){
			return Response::json(array(
			'error' => true,
			'mensaje' => $e->getMessage()),
			200
			);
		}
	}
	public function setGroups($id){
		try {
			$u = $this->modelo->findOrfail($id);
			$u->groups()->detach();
			$data = Input::all();
			$postGroups = $data["groups"];
			$u->groups()->attach($postGroups);
			$groups = $u->groups()->get();
			return Response::json(array('error'=>false,"listado"=>$groups->toArray()),200);
		} catch(\Exception $e){
			return Response::json(array(
			'error' => true,
			'mensaje' => $e->getMessage()),
			200
			);
		}
	}
	public function roles($id){
		try {
			$u = $this->modelo->findOrfail($id);
			$roles = $u->roles()->get();
			return Response::json(array('error'=>false,"listado"=>$roles->toArray()),200);
		} catch(\Exception $e){
			return Response::json(array(
			'error' => true,
			'mensaje' => $e->getMessage()),
			200
			);
		}
	}

	public function setPassword($id){
		try {
			$u = $this->modelo->findOrfail($id);
			if(Auth::user()->es_admin == false){
				return Response::json(array('error'=>true,'mensaje'=>'no tiene permisos suficientes'),200);
			}
			if ($u->setPassword(Input::get('password'))){
				return Response::json(array('error'=>false,"listado"=>$u->toArray()),200);
			} else {
				return Response::json(array('error'=>true,'mensaje'=>'ocurrio un error.'),200);
			}
		} catch(\Exception $e){
			return Response::json(array(
			'error' => true,
			'mensaje' => $e->getMessage()),
			200
			);
		}

	}
	
	public function setEsquemaColor($id){
		try {
			$u = $this->modelo->findOrfail($id);
			if (Request::isMethod('post')){
				$esquema_color_id = Input::get('esquema_color_id');
				$u->esquema_color_id = $esquema_color_id;
				if ($u->save()){
					return Response::json(array('error'=>false,"listado"=>$u->toArray()),200);
				} else {
					return Response::json(array('error'=>true,'mensaje'=>'ocurrio un error.'),200);
				}
			} else {
				$esquema = (NULL != $u->esquema_color_id)?$u->esquema_color()->first()->toArray():[];
				return Response::json(array('error'=>false,"listado"=>$esquema),200);
			}
		} catch(\Exception $e){
			return Response::json(array(
			'error' => true,
			'mensaje' => $e->getMessage()),
			200
			);
		}

	}

}
