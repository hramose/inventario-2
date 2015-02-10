<?php

class ClienteController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $clientes = Cliente::where('estado', 1)->paginate();
		return View::make('admin/clientes/list')->with('clientes', $clientes);
	}



	public function search(){

		$busqueda = Input::get('nombre');
		$clientes = Cliente::where('nombre', 'LIKE' , '%'.$busqueda.'%')->paginate();
		return View::make('admin/clientes/list')->with('clientes', $clientes);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$cliente = new Cliente();

		return View::make('admin/clientes/form')->with('cliente', $cliente);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$cliente = new Cliente();

		# Obtenemos la data enviada por el usuario
		$data = Input::all();

		if ($cliente->validAndSave($data)){
            return Redirect::route('admin.clientes.show', array($cliente->id));
        }
        else{
            return Redirect::route('admin.clientes.create')->withInput()->withErrors($cliente->errors);
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
		$cliente = Cliente::find($id);

		if(!is_null($cliente)){
			return View::make('admin/clientes/show')->with('cliente', $cliente);
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
		$cliente = Cliente::find($id);

		if (is_null ($cliente)){
			App::abort(404);
		}

		return View::make('admin/clientes/form')->with('cliente', $cliente);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$cliente = Cliente::find($id);

		if(is_null($cliente)){
			App::abort(404);
		}

		$data = Input::All();

		if ($cliente->validAndSave($data)){
            return Redirect::route('admin.clientes.show', array($cliente->id));
        }
        else{
            return Redirect::route('admin.clientes.edit', $cliente->id)->withInput()->withErrors($cliente->errors);
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
		$cliente = Cliente::find($id);

		if(is_null($cliente)){
			App::abort(404);
		}

		$cliente->estado = false;
		$cliente->save();


		if (Request::ajax())
        {

            return Response::json(array(
                'msg'     => '¡ cliente '.$cliente->nombre.' eliminado !',
                'id'      => $cliente->id
            ));
        }
        else
        {
            return Redirect::route('admin.clientes.index');
        }

	}


}
