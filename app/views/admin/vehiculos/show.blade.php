@extends ('admin/layout')

@section ('title') Vehiculo {{ $vehiculo->nombre }} @stop

@section ('content')


    <h3>Vehiculo</h3>

    <br>

    <p>
        <a href="{{ route('admin.vehiculos.index') }}" class="btn btn-primary">Volver a la Lista</a>
        <a href="{{ route('admin.vehiculos.create') }}" class="btn btn-primary">Crear un nuevo Vehiculo</a>
    </p>

    <br>
  
    <div class="panel panel-info">

        <div class="panel-heading">{{ $vehiculo->nombre }}</div>
        <div class="panel-body">

        	<div class="input-group">
                <span class="input-group-addon" >Encargado</span>
                <span class="form-control" >{{ $vehiculo->direccion }}</span>
            </div>

            <div class="input-group">
                <span class="input-group-addon" >Teléfono</span>
                <span class="form-control" >{{ $vehiculo->fono }}</span>
            </div>

            <div class="input-group">
                <span class="input-group-addon" >Vigente</span>
                <span class="form-control" >{{ $vehiculo->estado }}</span>
            </div>

        </div>

        <div class="panel-footer">
            <a href="{{ route('admin.vehiculos.edit', $vehiculo->id) }}" class="btn btn-primary">Editar</a>
            <br><br>
            {{ Form::model($vehiculo, array('route' => array('admin.vehiculos.destroy', $vehiculo->id), 'method' => 'DELETE'), array('role' => 'form')) }}
                {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
            {{ Form::close() }}
        </div>
    </div>
@stop