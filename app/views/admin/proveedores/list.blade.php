@extends ('admin/layout')

@section ('title') Lista de Proveedores @stop

@section ('content')


  <h3>Lista de Proveedores</h3>

  <p>
    <a href="{{ route('admin.proveedores.create') }}" class="btn btn-primary">Crear un nuevo proveedor</a>
  </p>
  
  <table class="table table-striped">
    <tr> 	
        <th>Nombre</th>
        <th>Fono</th>
        <th>Dirección</th>
        <th>Acciones</th>
    </tr>
    @foreach ($proveedores as $proveedor)
    <tr>
    	<td>{{ $proveedor->nombre }}</td>
    	<td>{{ $proveedor->fono }}</td>
    	<td>{{ $proveedor->direccion }}</td>
        <td>
        	<a href="{{ route('admin.proveedores.show', array($proveedor->id)) }}" class="icono-accion">
        		<span class="glyphicon glyphicon-search"></span>
        	</a>
        	<a href="{{ route('admin.proveedores.edit', $proveedor->id) }}" class="icono-accion">
        		<span class="glyphicon glyphicon-pencil"></span>
        	</a>
        </td>
    </tr>
    @endforeach
  </table>

  {{ $proveedores->links() }}

{{-- Formulario para eliminar registro --}}
{{ Form::open(array('route' => array('admin.proveedores.destroy', 'proveedor_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) }}
{{ Form::close() }}
@stop