<?php

class ProductoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $productos = Producto::where('estado', 1)->paginate();
		return View::make('admin/productos/list')->with('productos', $productos);
	}



	public function search(){

		$busqueda = Input::get('nombre');
		$productos = Producto::where('nombre', 'LIKE' , '%'.$busqueda.'%')->paginate();



		
		return View::make('admin/productos/list')->with('productos', $productos);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$producto = new Producto();

		return View::make('admin/productos/form')->with('producto', $producto);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$producto = new Producto();

		# Obtenemos la data enviada por el usuario
		$data = Input::all();

		if ($producto->validAndSave($data)){

            return Redirect::route('admin.productos.show', array($producto->id));
        }
        else{
            return Redirect::route('admin.productos.create')->withInput()->withErrors($producto->errors);
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
		$producto = Producto::find($id);

		if(!is_null($producto)){
			return View::make('admin/productos/show')->with('producto', $producto);
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
		$producto = Producto::find($id);

		if (is_null ($producto)){
			App::abort(404);
		}

		return View::make('admin/productos/form')->with('producto', $producto);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$producto = Producto::find($id);

		if(is_null($producto)){
			App::abort(404);
		}

		$data = Input::All();

		if ($producto->validAndSave($data)){
            return Redirect::route('admin.productos.show', array($producto->id));
        }
        else{
            return Redirect::route('admin.productos.edit', $producto->id)->withInput()->withErrors($producto->errors);
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
		$producto = Producto::find($id);

		if(is_null($producto)){
			App::abort(404);
		}

		$producto->estado = false;
		$producto->save();


		if (Request::ajax())
        {

            return Response::json(array(
                'msg'     => '¡ producto '.$producto->nombre.' eliminado !',
                'id'      => $producto->id
            ));
        }
        else
        {
            return Redirect::route('admin.productos.index');
        }

	}

	public function getStock($id_producto){

		return "suma cantidad stock !";
	}


}
