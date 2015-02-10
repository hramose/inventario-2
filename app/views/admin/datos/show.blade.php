@extends ('admin/layout')

@section ('title') Dato {{ $dato->nombre }} @stop

@section ('content')


    <h3>Dato</h3>

    <br>

    <p>
        <a href="{{ route('admin.datos.index') }}" class="btn btn-primary">Volver a la Lista</a>
        <a href="{{ route('admin.datos.create') }}" class="btn btn-primary">Crear un nuevo Dato</a>
    </p>

    <br>
  
    <div class="panel panel-info">

        <div class="panel-heading">{{ $dato->nombre }}</div>
        <div class="panel-body">

            <div class="input-group">
                <span class="input-group-addon" >Valor</span>
                <span class="form-control" >{{ $dato->valor }}</span>
            </div>

        </div>

        <div class="panel-footer">
            <a href="{{ route('admin.datos.edit', $dato->id) }}" class="btn btn-primary">Editar</a>
            <br><br>

            <!--
            	{{ Form::model($dato, array('route' => array('admin.datos.destroy', $dato->id), 'method' => 'DELETE'), array('role' => 'form')) }}
                	{{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
            	{{ Form::close() }}
        	-->
        </div>
    </div>
@stop