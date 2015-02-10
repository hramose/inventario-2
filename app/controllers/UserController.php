<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::where('vigente', 1)->paginate();
		return View::make('admin/users/list')->with('users', $users);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$user = new User();

		return View::make('admin/users/form')->with('user', $user);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = new User();

		# Obtenemos la data enviada por el usuario
		$data = Input::all();

		if ($user->validAndSave($data)){
            return Redirect::route('admin.users.show', array($user->id));
        }
        else{
            return Redirect::route('admin.users.create')->withInput()->withErrors($user->errors);
        }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::find($id);

		if(!is_null($user)){
			return View::make('admin/users/show')->with('user', $user);
		}else{
			App::abort(404);
		}
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);

		if (is_null ($user)){
			App::abort(404);
		}

		return View::make('admin/users/form')->with('user', $user);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::find($id);

		if(is_null($user)){
			App::abort(404);
		}

		$data = Input::All();

		if ($user->validAndSave($data)){
            return Redirect::route('admin.users.show', array($user->id));
        }
        else{
            return Redirect::route('admin.users.edit', $user->id)->withInput()->withErrors($user->errors);
        }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);

		if(is_null($user)){
			App::abort(404);
		}

		$user->vigente = false;
		$user->save();


		if (Request::ajax())
        {

            return Response::json(array(
                'msg' 	=> '¡ Usuario '.$user->full_name .' eliminado !',
                'id'	=> $user->id
            ));
        }
        else
        {
            return Redirect::route('admin.users.index');
        }
	}



}
