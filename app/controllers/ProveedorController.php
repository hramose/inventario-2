<?php

class ProveedorController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $proveedores = Proveedor::where('estado', 1)->paginate();
		return View::make('admin/proveedores/list')->with('proveedores', $proveedores);
	}



	public function search(){

		$busqueda = Input::get('nombre');
		$proveedores = Proveedor::where('nombre', 'LIKE' , '%'.$busqueda.'%')->paginate();
		return View::make('admin/proveedores/list')->with('proveedores', $proveedores);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$proveedor = new Proveedor();

		return View::make('admin/proveedores/form')->with('proveedor', $proveedor);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$proveedor = new Proveedor();

		# Obtenemos la data enviada por el usuario
		$data = Input::all();

		if ($proveedor->validAndSave($data)){
            return Redirect::route('admin.proveedores.show', array($proveedor->id));
        }
        else{
            return Redirect::route('admin.proveedores.create')->withInput()->withErrors($proveedor->errors);
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
		$proveedor = Proveedor::find($id);

		if(!is_null($proveedor)){
			return View::make('admin/proveedores/show')->with('proveedor', $proveedor);
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
		$proveedor = Proveedor::find($id);

		if (is_null ($proveedor)){
			App::abort(404);
		}

		return View::make('admin/proveedores/form')->with('proveedor', $proveedor);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$proveedor = Proveedor::find($id);

		if(is_null($proveedor)){
			App::abort(404);
		}

		$data = Input::All();

		if ($proveedor->validAndSave($data)){
            return Redirect::route('admin.proveedores.show', array($proveedor->id));
        }
        else{
            return Redirect::route('admin.proveedores.edit', $proveedor->id)->withInput()->withErrors($proveedor->errors);
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
		$proveedor = Proveedor::find($id);

		if(is_null($proveedor)){
			App::abort(404);
		}

		$proveedor->estado = false;
		$proveedor->save();


		if (Request::ajax())
        {

            return Response::json(array(
                'msg'     => '¡ proveedor '.$proveedor->nombre.' eliminado !',
                'id'      => $proveedor->id
            ));
        }
        else
        {
            return Redirect::route('admin.proveedores.index');
        }

	}

}
