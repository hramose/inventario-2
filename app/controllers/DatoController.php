<?php

class datoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $datos = Dato::paginate();
		return View::make('admin/datos/list')->with('datos', $datos);
	}



	public function search(){

		$busqueda = Input::get('nombre');
		$datos = Dato::where('nombre', 'LIKE' , '%'.$busqueda.'%')->paginate();
		return View::make('admin/datos/list')->with('datos', $datos);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$dato = new Dato();

		return View::make('admin/datos/form')->with('dato', $dato);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$dato = new Dato();

		# Obtenemos la data enviada por el usuario
		$data = Input::all();

		if ($dato->validAndSave($data)){
            return Redirect::route('admin.datos.show', array($dato->id));
        }
        else{
            return Redirect::route('admin.datos.create')->withInput()->withErrors($dato->errors);
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
		$dato = Dato::find($id);

		if(!is_null($dato)){
			return View::make('admin/datos/show')->with('dato', $dato);
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
		$dato = Dato::find($id);

		if (is_null ($dato)){
			App::abort(404);
		}

		return View::make('admin/datos/form')->with('dato', $dato);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$dato = Dato::find($id);

		if(is_null($dato)){
			App::abort(404);
		}

		$data = Input::All();

		if ($dato->validAndSave($data)){
            return Redirect::route('admin.datos.show', array($dato->id));
        }
        else{
            return Redirect::route('admin.datos.edit', $dato->id)->withInput()->withErrors($dato->errors);
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
		$dato = Dato::find($id);

		if(is_null($dato)){
			App::abort(404);
		}

		//$dato->estado = false;
		$dato->save();


		if (Request::ajax())
        {

            return Response::json(array(
                'msg'     => '¡ dato '.$dato->nombre.' eliminado !',
                'id'      => $dato->id
            ));
        }
        else
        {
            return Redirect::route('admin.datos.index');
        }

	}


}
