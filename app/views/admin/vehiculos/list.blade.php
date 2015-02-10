@extends ('admin/layout')

@section ('title') Lista de vehiculos @stop

@section ('content')


  <h3>Lista de vehiculos</h3>

  <p>
    <a href="{{ route('admin.vehiculos.create') }}" class="btn btn-primary">Crear un nuevo Vehiculo</a>
  </p>
  
  <table class="table table-striped">
    <tr> 	
        <th>Nombre</th>
        <th>Encargado</th>
        <th>Fono</th>
        <th>Acciones</th>
    </tr>
    @foreach ($vehiculos as $vehiculo)
    <tr>
    	<td>{{ $vehiculo->nombre }}</td>
    	<td>{{ $vehiculo->direccion }}</td>
    	<td>{{ $vehiculo->fono }}</td>    	
        <td>
        	<a href="{{ route('admin.vehiculos.show', array($vehiculo->id)) }}" class="icono-accion">
        		<span class="glyphicon glyphicon-search"></span>
        	</a>
        	<a href="{{ route('admin.vehiculos.edit', $vehiculo->id) }}" class="icono-accion">
        		<span class="glyphicon glyphicon-pencil"></span>
        	</a>
        </td>
    </tr>
    @endforeach
  </table>

  {{ $vehiculos->links() }}

{{-- Formulario para eliminar registro --}}
{{ Form::open(array('route' => array('admin.vehiculos.destroy', 'cliente_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) }}
{{ Form::close() }}
@stop