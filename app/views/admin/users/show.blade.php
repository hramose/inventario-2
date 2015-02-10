@extends ('admin/layout')

@section ('title') Usuario {{ $user->full_name }} @stop

@section ('content')


    <h3>Usuario</h3>

    <br>

    <p>
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Volver a la Lista</a>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Crear un nuevo Usuario</a>
    </p>

    <br>
  
    <div class="panel panel-info">

        <div class="panel-heading">{{ $user->full_name }}</div>
        <div class="panel-body">

            <div class="input-group">
                <span class="input-group-addon" >Email</span>
                <span class="form-control" >{{ $user->email }}</span>
            </div>

            <div class="input-group">
                <span class="input-group-addon" >Vigente</span>
                <span class="form-control" >{{ $user->vigente }}</span>
            </div>

        </div>

        <div class="panel-footer">
            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Editar</a>
            <br><br>
            {{ Form::model($user, array('route' => array('admin.users.destroy', $user->id), 'method' => 'DELETE'), array('role' => 'form')) }}
                {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
            {{ Form::close() }}
        </div>
    </div>
@stop