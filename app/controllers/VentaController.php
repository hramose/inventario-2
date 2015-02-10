<?php

class ventaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $ventas = Venta::paginate();
		return View::make('admin/ventas/list')->with('ventas', $ventas);
	}



	public function search(){

		$busqueda = Input::get('nombre');
		$ventas = Venta::where('nombre', 'LIKE' , '%'.$busqueda.'%')->paginate();
		return View::make('admin/ventas/list')->with('ventas', $ventas);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$venta = new Venta();

		$compras = Compra::has('stocks', '>', 0)->get();

		// Obtengo Lista de Clientes
			$combobox = Vehiculo::where('estado', 1)->lists('nombre','id');
			$vehiculos = array(0 => "Seleccione Vehiculo ") + $combobox;
			$select_vehiculo = 0;

		return View::make('admin/ventas/productos')	->with('venta', $venta)
												->with('compras', $compras)
												->with('vehiculos', $vehiculos)
											  	->with('select_vehiculo', $select_vehiculo);

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


		if( $this->sumarStock($producto_id, $cantidad) ){

			$venta = new Venta();
			# Obtenemos la data enviada por el usuario
			$data = Input::all();

			if ($venta->validAndSave($data)){
	            return Redirect::route('admin.ventas.show', array($venta->id));
	        }
	        else{
	            return Redirect::route('admin.ventas.create')->withInput()->withErrors($venta->errors);
	        }


		}else{
			return Redirect::route('admin.ventas.create')->withInput()->withErrors($venta->errors);
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
		$venta = Venta::find($id);

		if(!is_null($venta)){
			return View::make('admin/ventas/show')->with('venta', $venta);
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
		$venta = Venta::find($id);

		if (is_null ($venta)){
			App::abort(404);
		}

		// Obtengo Lista de productos
			$productos = Producto::all()->lists('nombre','id');	asort($productos);
			$select_producto = $venta->producto_id;

		// Obtengo Lista de proveedores
			$proveedores = Proveedor::all()->lists('nombre','id');	asort($proveedores);
			$select_proveedor = $venta->proveedor_id;

		// Obtengo Lista de proveedores
			$bancos = Banco::all()->lists('nombre','id');	asort($bancos);
			$select_banco = $venta->banco_id;

		return View::make('admin/ventas/form')->with('venta', $venta)
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
		// para actualizar el stock, debemos obtener el primer ingreso y el nuevo, obtener la diferencia y actualizar

		$producto_id = Input::get('producto_id');

		//peguntamos por el stock existente
		$stocks = Stock::where('producto_id' ,'=', $producto_id)->get();

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

		if( $this->editarStock($producto_id, $diferencia) ){

			$venta = venta::find($id);

			if(is_null($venta)){
				App::abort(404);
			}

			$data = Input::All();

			if ($venta->validAndSave($data)){
	            return Redirect::route('admin.ventas.show', array($venta->id));
	        }
	        else{
	            return Redirect::route('admin.ventas.edit', $venta->id)->withInput()->withErrors($venta->errors);
	        }


		}else{
			return Redirect::route('admin.ventas.create')->withInput()->withErrors($venta->errors);
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
		$venta = Venta::find($id);

		if(is_null($venta)){
			App::abort(404);
		}

		//$venta->estado = false; venta NO TIENE ESTADO Y NO SE ELIMINARÁN
		$venta->save();


		if (Request::ajax())
        {

            return Response::json(array(
                'msg'     => '¡ venta '.$venta->id.' eliminado !',
                'id'      => $venta->id
            ));
        }
        else
        {
            return Redirect::route('admin.ventas.index');
        }

	}






	public function sumarStock($producto_id, $numero)
    {

    	$stock = Stock::where('producto_id' ,'=', $producto_id)->get();


   		$i=0;
		foreach ($stock as $key => $value) {

			if(empty($value->id)){
				$i++;
			}
		}




		if($i==0){

			$nuevo_stock = new Stock();
			$data['cantidad']= $numero;
			$data['producto_id'] = $producto_id;

			if ($nuevo_stock->validAndSave($data)){
            	return true;
	        }
	        else{
	            return false;
	        }

		}else{

			foreach ($stock as $st) {

				$data['id']	= $st->id;
				$data['cantidad']= $numero + $st->cantidad;
				$data['producto_id'] = $producto_id;
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



    public function editarStock($producto_id, $diferencia)
    {

    	$stock = Stock::where('producto_id' ,'=', $producto_id)->get();

    	foreach ($stock as $st) {
    		$data['id'] = $st->id;
			$data['cantidad']= $st->cantidad + $diferencia;
			$data['producto_id'] = $producto_id;
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
