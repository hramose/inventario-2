<?php

class VehiculoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $vehiculos = Vehiculo::where('estado', 1)->paginate();
		return View::make('admin/vehiculos/list')->with('vehiculos', $vehiculos);
	}



	public function search(){

		$busqueda = Input::get('nombre');
		$vehiculos = vehiculo::where('nombre', 'LIKE' , '%'.$busqueda.'%')->paginate();
		return View::make('admin/vehiculos/list')->with('vehiculos', $vehiculos);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$vehiculo = new Vehiculo();

		return View::make('admin/vehiculos/form')->with('vehiculo', $vehiculo);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$vehiculo = new Vehiculo();

		# Obtenemos la data enviada por el usuario
		$data = Input::all();

		if ($vehiculo->validAndSave($data)){
            return Redirect::route('admin.vehiculos.show', array($vehiculo->id));
        }
        else{
            return Redirect::route('admin.vehiculos.create')->withInput()->withErrors($vehiculo->errors);
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
		$vehiculo = Vehiculo::find($id);

		if(!is_null($vehiculo)){
			return View::make('admin/vehiculos/show')->with('vehiculo', $vehiculo);
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
		$vehiculo = Vehiculo::find($id);

		if (is_null ($vehiculo)){
			App::abort(404);
		}

		return View::make('admin/vehiculos/form')->with('vehiculo', $vehiculo);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$vehiculo = Vehiculo::find($id);

		if(is_null($vehiculo)){
			App::abort(404);
		}

		$data = Input::All();

		if ($vehiculo->validAndSave($data)){
            return Redirect::route('admin.vehiculos.show', array($vehiculo->id));
        }
        else{
            return Redirect::route('admin.vehiculos.edit', $vehiculo->id)->withInput()->withErrors($vehiculo->errors);
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
		$vehiculo = Vehiculo::find($id);

		if(is_null($vehiculo)){
			App::abort(404);
		}

		$vehiculo->estado = false;
		$vehiculo->save();


		if (Request::ajax())
        {

            return Response::json(array(
                'msg'     => '¡ vehiculo '.$vehiculo->nombre.' eliminado !',
                'id'      => $vehiculo->id
            ));
        }
        else
        {
            return Redirect::route('admin.vehiculos.index');
        }

	}


}
