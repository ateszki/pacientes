<?php

class GroupController extends MaestroController {

	function __construct(){
		$this->classname= 'Group';
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

	public function users($id){
		try {
			$g = $this->modelo->findOrfail($id);
			$users = $g->users()->get();
			return Response::json(array('error'=>false,"listado"=>$users->toArray()),200);
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
			$g = $this->modelo->findOrfail($id);
			$roles = $g->roles()->get();
			return Response::json(array('error'=>false,"listado"=>$roles->toArray()),200);
		} catch(\Exception $e){
			return Response::json(array(
			'error' => true,
			'mensaje' => $e->getMessage()),
			200
			);
		}
	}

	public function setUsers($id){
		try {
			$g = $this->modelo->findOrfail($id);
			$g->users()->detach();
			$data = Input::all();
			$postUsers = $data["users"];
			$g->users()->attach($postUsers);
			$users = $g->users()->get();
			return Response::json(array('error'=>false,"listado"=>$users->toArray()),200);
		} catch(\Exception $e){
			return Response::json(array(
			'error' => true,
			'mensaje' => $e->getMessage()),
			200
			);
		}
	}
	
	public function setRoles($id){
		try {
			$g = $this->modelo->findOrfail($id);
			$g->roles()->detach();
			$data = Input::all();
			$postRoles = $data["roles"];
			$g->roles()->attach($postRoles);
			$roles = $g->roles()->get();
			return Response::json(array('error'=>false,"listado"=>$roles->toArray()),200);
		} catch(\Exception $e){
			return Response::json(array(
			'error' => true,
			'mensaje' => $e->getMessage()),
			200
			);
		}
	}
}
