@extends ('admin/layout')

@section ('title') Lista de Clientes @stop

@section ('content')


  <h3>Lista de Clientes</h3>

  <p>
    <a href="{{ route('admin.clientes.create') }}" class="btn btn-primary">Crear un nuevo Cliente</a>
  </p>
  
  <table class="table table-striped">
    <tr> 	
        <th>Nombre</th>
        <th>Fono</th>
        <th>Dirección</th>
        <th>Acciones</th>
    </tr>
    @foreach ($clientes as $cliente)
    <tr>
    	<td>{{ $cliente->nombre }}</td>
    	<td>{{ $cliente->fono }}</td>
    	<td>{{ $cliente->direccion }}</td>
        <td>
        	<a href="{{ route('admin.clientes.show', array($cliente->id)) }}" class="icono-accion">
        		<span class="glyphicon glyphicon-search"></span>
        	</a>
        	<a href="{{ route('admin.clientes.edit', $cliente->id) }}" class="icono-accion">
        		<span class="glyphicon glyphicon-pencil"></span>
        	</a>
        </td>
    </tr>
    @endforeach
  </table>

  {{ $clientes->links() }}

{{-- Formulario para eliminar registro --}}
{{ Form::open(array('route' => array('admin.clientes.destroy', 'cliente_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) }}
{{ Form::close() }}
@stop