<?php

class compraController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $compras = Compra::paginate();
		return View::make('admin/compras/list')->with('compras', $compras);
	}



	public function search(){

		$busqueda = Input::get('nombre');
		$compras = Compra::where('nombre', 'LIKE' , '%'.$busqueda.'%')->paginate();
		return View::make('admin/compras/list')->with('compras', $compras);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$compra = new Compra();


		// Obtengo Lista de Clientes
			$combobox = Producto::where('estado', 1)->lists('nombre','id');
			$productos = array(0 => "Seleccione... ") + $combobox;
			$select_producto = 0;

		// Obtengo Lista de bancos
			$combobox = Banco::where('vigente', 1)->lists('nombre','id');
			$bancos = array(0 => "Seleccione... ") + $combobox;
			$select_banco = 0;

		// Obtengo Lista de Propiedades
			$combobox = Proveedor::where('estado', 1)->lists('nombre','id');
			$proveedores = array(0 => "Seleccione... ") + $combobox;
			$select_proveedor = 0;

		return View::make('admin/compras/form')	->with('compra', $compra)
												->with('productos', $productos)
											  	->with('select_producto', $select_producto)
											  	->with('proveedores', $proveedores)
											  	->with('select_proveedor', $select_proveedor)
											  	->with('bancos', $bancos)
											  	->with('select_banco', $select_banco);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$cantidad = Input::get('cantidad');
		$producto_id = Input::get('producto_id');


		

		$compra = new Compra();
		# Obtenemos la data enviada por el usuario
		$data = Input::all();

		if ($compra->validAndSave($data)){

			if(!$this->sumarStock($compra->id, $cantidad)){
				return Redirect::route('admin.compras.create')->withInput()->withErrors($this->errors);
			}else{
				return Redirect::route('admin.compras.show', array($compra->id));
			}			
            
        }
        else{
            return Redirect::route('admin.compras.create')->withInput()->withErrors($compra->errors);
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
		$compra = Compra::find($id);

		if(!is_null($compra)){
			return View::make('admin/compras/show')->with('compra', $compra);
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
		$compra = Compra::find($id);

		if (is_null ($compra)){
			App::abort(404);
		}

		// Obtengo Lista de productos
			$productos = Producto::all()->lists('nombre','id');	asort($productos);
			$select_producto = $compra->producto_id;

		// Obtengo Lista de proveedores
			$proveedores = Proveedor::all()->lists('nombre','id');	asort($proveedores);
			$select_proveedor = $compra->proveedor_id;

		// Obtengo Lista de proveedores
			$bancos = Banco::all()->lists('nombre','id');	asort($bancos);
			$select_banco = $compra->banco_id;

		return View::make('admin/compras/form')->with('compra', $compra)
												->with('productos', $productos)
											  	->with('select_producto', $select_producto)
											  	->with('proveedores', $proveedores)
											  	->with('select_proveedor', $select_proveedor)
											  	->with('bancos', $bancos)
											  	->with('select_banco', $select_banco);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		//peguntamos por el stock existente
		$stocks = Stock::where('compra_id' ,'=', $id)->get();

		//abortamos si no existe
		if(is_null($stocks)){
			App::abort(404);
		}

		foreach ($stocks as $stock) {
			//obtenemos la cantidad
			$original = $stock->cantidad;
		}

		
		//obtenemos el nuevo valor
		$cantidad = Input::get('cantidad');
		//obtenemos la diferencia
		$diferencia = $cantidad-$original;

		$nuevoStock = new Stock();

		if( $this->editarStock($id, $diferencia) ){

			$compra = Compra::find($id);

			if(is_null($compra)){
				App::abort(404);
			}

			$data = Input::All();

			if ($compra->validAndSave($data)){
	            return Redirect::route('admin.compras.show', array($compra->id));
	        }
	        else{
	            return Redirect::route('admin.compras.edit', $compra->id)->withInput()->withErrors($compra->errors);
	        }


		}else{
			return Redirect::route('admin.compras.create')->withInput()->withErrors($compra->errors);
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
		$compra = Compra::find($id);

		if(is_null($compra)){
			App::abort(404);
		}

		//$compra->estado = false; COMPRA NO TIENE ESTADO Y NO SE ELIMINARÁN
		$compra->save();


		if (Request::ajax())
        {

            return Response::json(array(
                'msg'     => '¡ compra '.$compra->id.' eliminado !',
                'id'      => $compra->id
            ));
        }
        else
        {
            return Redirect::route('admin.compras.index');
        }

	}






	public function sumarStock($compra_id, $numero)
    {

    	$stock = Stock::where('compra_id' ,'=', $compra_id)->get();

		$nuevo_stock = new Stock();
		$data['cantidad']= $numero;
		$data['compra_id'] = $compra_id;

		if ($nuevo_stock->validAndSave($data)){
        	return true;
        }
        else{
            return false;
        }

    }



    public function editarStock($compra_id, $diferencia)
    {

    	$stock = Stock::where('compra_id' ,'=', $compra_id)->get();

    	foreach ($stock as $st) {
    		$data['id'] = $st->id;
			$data['cantidad']= $st->cantidad + $diferencia;
			$data['compra_id'] = $compra_id;
    	}

    	$ss = Stock::find( $data['id'] );

		if ($ss->validAndSave($data)){
        	return true;
        }
        else{
            return false;
        }

    }




}
