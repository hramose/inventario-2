@extends ('admin/layout')

@section ('title') Lista de ventas @stop

@section ('content')


  <h3>Lista de ventas</h3>

  <p>
    <a href="{{ route('admin.ventas.create') }}" class="btn btn-primary">Registrar venta</a>
  </p>
  
  <div class="table-responsive">
	  <table class="table table-striped table-hover">
	    <tr> 	
	    	<th>N°</th>
	        <th>Producto</th>
	        <th>Cantidad</th>
	        <th>Costo Total IVA</th>
	        <th>Acciones</th>
	    </tr>
	    @foreach ($ventas as $venta)
	    <tr>
	    	<td>{{ $venta->id }}</td>
	    	<td>{{ $venta->producto->nombre }}</td>
	    	<td>{{ $venta->cantidad }}</td>
	    	<td>{{ $venta->costo_total_iva }}</td>
	        <td>
	        	<a href="{{ route('admin.ventas.show', array($venta->id)) }}" class="icono-accion">
	        		<span class="glyphicon glyphicon-search"></span>
	        	</a>
	        	<a href="{{ route('admin.ventas.edit', $venta->id) }}" class="icono-accion">
	        		<span class="glyphicon glyphicon-pencil"></span>
	        	</a>
	        </td>
	    </tr>
	    @endforeach
	  </table>
	</div>

  {{ $ventas->links() }}

{{-- Formulario para eliminar registro --}}
{{ Form::open(array('route' => array('admin.ventas.destroy', 'venta_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) }}
{{ Form::close() }}
@stop