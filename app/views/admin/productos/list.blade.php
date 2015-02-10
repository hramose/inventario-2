@extends ('admin/layout')

@section ('title') Lista de productos @stop

@section ('content')


  <h3>Lista de productos</h3>

  <p>
    <a href="{{ route('admin.productos.create') }}" class="btn btn-primary">Crear un nuevo Producto</a>
  </p>
  
  <table class="table table-striped">
    <tr> 	
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Stock</th>
        <th>Acciones</th>
    </tr>
    @foreach ($productos as $producto)
    <tr>
    	<td>{{ $producto->nombre }}</td>
    	<td>{{ $producto->descripcion }}</td>
    	<td>{{-- $producto->stock --}}</td>

        <td>
        	<a href="{{ route('admin.productos.show', array($producto->id)) }}" class="icono-accion">
        		<span class="glyphicon glyphicon-search"></span>
        	</a>
        	<a href="{{ route('admin.productos.edit', $producto->id) }}" class="icono-accion">
        		<span class="glyphicon glyphicon-pencil"></span>
        	</a>
        </td>
    </tr>
    @endforeach
  </table>

  {{ $productos->links() }}

{{-- Formulario para eliminar registro --}}
{{ Form::open(array('route' => array('admin.productos.destroy', 'cliente_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) }}
{{ Form::close() }}
@stop