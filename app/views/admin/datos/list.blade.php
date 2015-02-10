@extends ('admin/layout')

@section ('title') Lista de datos @stop

@section ('content')


  <h3>Lista de datos</h3>

  <p>
    <a href="{{ route('admin.datos.create') }}" class="btn btn-primary">Crear un nuevo Dato</a>
  </p>
  
  <table class="table table-striped">
    <tr> 	
        <th>Nombre</th>
        <th>Valor</th>
        <th>Acciones</th>
    </tr>
    @foreach ($datos as $dato)
    <tr>
    	<td>{{ $dato->nombre }}</td>
    	<td>{{ $dato->valor }}</td>
        <td>
        	<a href="{{ route('admin.datos.show', array($dato->id)) }}" class="icono-accion">
        		<span class="glyphicon glyphicon-search"></span>
        	</a>
        	<a href="{{ route('admin.datos.edit', $dato->id) }}" class="icono-accion">
        		<span class="glyphicon glyphicon-pencil"></span>
        	</a>
        </td>
    </tr>
    @endforeach
  </table>

  {{ $datos->links() }}

{{-- Formulario para eliminar registro --}}
{{ Form::open(array('route' => array('admin.datos.destroy', 'cliente_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) }}
{{ Form::close() }}
@stop