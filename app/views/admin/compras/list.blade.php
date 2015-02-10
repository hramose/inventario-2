@extends ('admin/layout')

@section ('title') Lista de compras @stop

@section ('content')


  <h3>Lista de compras</h3>

  <p>
    <a href="{{ route('admin.compras.create') }}" class="btn btn-primary">Registrar Compra</a>
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
	    @foreach ($compras as $compra)
	    <tr>
	    	<td>{{ $compra->id }}</td>
	    	<td>{{ $compra->producto->nombre }}</td>
	    	<td>{{ $compra->cantidad }}</td>
	    	<td>{{ $compra->costo_total_iva }}</td>
	        <td>
	        	<a href="{{ route('admin.compras.show', array($compra->id)) }}" class="icono-accion">
	        		<span class="glyphicon glyphicon-search"></span>
	        	</a>
	        	<a href="{{ route('admin.compras.edit', $compra->id) }}" class="icono-accion">
	        		<span class="glyphicon glyphicon-pencil"></span>
	        	</a>
	        </td>
	    </tr>
	    @endforeach
	  </table>
	</div>

  {{ $compras->links() }}

{{-- Formulario para eliminar registro --}}
{{ Form::open(array('route' => array('admin.compras.destroy', 'compra_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) }}
{{ Form::close() }}
@stop