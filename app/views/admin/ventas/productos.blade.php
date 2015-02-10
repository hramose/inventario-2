@extends ('admin/layout')

@section ('title') Lista de productos disponibles @stop

@section ('content')


  <h3>Productos disponibles para la venta</h3>

  	<br><br>
	
	<div class='row'>
		<div class='form-group col-md-3'>

            {{ Form::select('vehiculo_id', $vehiculos, $select_vehiculo, 
                array(  'class' => 'chosen-select form-control',
                        'data-placeholder' => 'Seleccione Vehiculo',
                        'tabindex' => '2'
                )) 
            }}

		</div>

		<div class='form-group col-md-3'>
			<button type="button" class="btn btn-warning">Registrar Merma</button>
	  		<button type="button" class="btn btn-success">Despachar</button>	  		
		</div>
	</div>

	<br>
 	
  
  <table class="table table-striped">
    <tr> 	
        <th>Nombre</th>
        <th>LOTE</th>
        <th>Stock</th>
        <th>Unitario IVA</th>
        <th>cantidad</th>
        <th>Total IVA</th>
    </tr>

    @foreach ($compras as $compra)
    <tr>
		<input type='hidden' id='costo_uni_iva_{{ $compra->id }}' value='{{ $compra->costo_unitario_iva }}'>

    	<td>{{ $compra->producto->nombre }}</td>
    	<td>{{ $compra->id }}</td>
    	<td>{{ $compra->stocks->cantidad}}</td>
    	<td>{{ number_format($compra->costo_unitario_iva) }}</td>
    	<td class='tdfijo'>
    		<button type="button" class="btn btn-info btn-sm icon-minus numuni" id='menos_{{ $compra->id }}'></button>

    		<input type='text' class='num_unidades' id='cantidad_{{ $compra->id }}'>
    		<button type="button" class="btn btn-info btn-sm icon-plus numuni" id='mas_{{ $compra->id }}'></button>
    	</td>
    	<td><label class='calcValorIVA' id='total_{{ $compra->id }}'></td>
    </tr>
    @endforeach

    <tr>
    		
		<td colspan='5'></td>
        <td><label id='precio_total'></label></td>
        <td></td>

    </tr>

  </table>



{{ Form::open(array('route' => array('admin.productos.destroy', 'cliente_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) }}
{{ Form::close() }}
@stop