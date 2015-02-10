@extends ('admin/layout')

@section ('title') Lista de Usuarios @stop

@section ('content')


  <h3>Lista de Usuarios</h3>

  <p>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Crear un nuevo usuario</a>
  </p>
  
  <table class="table table-striped">
    <tr> 	
        <th>Nombre Completo</th>
        <th>Email</th>
        <th>Acciones</th>
    </tr>
    @foreach ($users as $user)
    <tr>
    	<td>{{ $user->full_name }}</td>
    	<td>{{ $user->email }}</td>
        <td>
        	<a href="{{ route('admin.users.show', array($user->id)) }}" class="icono-accion">
        		<span class="glyphicon glyphicon-search"></span>
        	</a>
        	<a href="{{ route('admin.users.edit', $user->id) }}" class="icono-accion">
        		<span class="glyphicon glyphicon-pencil"></span>
        	</a>
        </td>
    </tr>
    @endforeach
  </table>

  {{ $users->links() }}

{{-- Formulario para eliminar registro --}}
{{ Form::open(array('route' => array('admin.users.destroy', 'USER_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) }}
{{ Form::close() }}
@stop