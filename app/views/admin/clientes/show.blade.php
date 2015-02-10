@extends ('admin/layout')

@section ('title') Cliente {{ $cliente->nombre }} @stop

@section ('content')


    <h3>Cliente</h3>

    <br>

    <p>
        <a href="{{ route('admin.clientes.index') }}" class="btn btn-primary">Volver a la Lista</a>
        <a href="{{ route('admin.clientes.create') }}" class="btn btn-primary">Crear un nuevo cliente</a>
    </p>

    <br>
  
    <div class="panel panel-info">

        <div class="panel-heading">{{ $cliente->nombre }}</div>
        <div class="panel-body">

            <div class="input-group">
                <span class="input-group-addon" >Teléfono</span>
                <span class="form-control" >{{ $cliente->fono }}</span>
            </div>

            <div class="input-group">
                <span class="input-group-addon" >Dirección</span>
                <span class="form-control" >{{ $cliente->direccion }}</span>
            </div>

            <div class="input-group">
                <span class="input-group-addon" >Vigente</span>
                <span class="form-control" >{{ $cliente->estado }}</span>
            </div>

        </div>

        <div class="panel-footer">
            <a href="{{ route('admin.clientes.edit', $cliente->id) }}" class="btn btn-primary">Editar</a>
            <br><br>
            {{ Form::model($cliente, array('route' => array('admin.clientes.destroy', $cliente->id), 'method' => 'DELETE'), array('role' => 'form')) }}
                {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
            {{ Form::close() }}
        </div>
    </div>
@stop