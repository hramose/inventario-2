@extends ('admin/layout')

@section ('title') Producto {{ $producto->nombre }} @stop

@section ('content')


    <h3>Producto</h3>

    <br>

    <p>
        <a href="{{ route('admin.productos.index') }}" class="btn btn-primary">Volver a la Lista</a>
        <a href="{{ route('admin.productos.create') }}" class="btn btn-primary">Crear un nuevo Producto</a>
    </p>

    <br>
  
    <div class="panel panel-info">

        <div class="panel-heading">{{ $producto->nombre }}</div>
        <div class="panel-body">

            <div class="input-group">
                <span class="input-group-addon" >Descripción</span>
                <span class="form-control" >{{ $producto->descripcion }}</span>
            </div>

            <div class="input-group">
                <span class="input-group-addon" >Vigente</span>
                <span class="form-control" >{{ $producto->estado }}</span>
            </div>

        </div>

        <div class="panel-footer">
            <a href="{{ route('admin.productos.edit', $producto->id) }}" class="btn btn-primary">Editar</a>
            <br><br>
            {{ Form::model($producto, array('route' => array('admin.productos.destroy', $producto->id), 'method' => 'DELETE'), array('role' => 'form')) }}
                {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
            {{ Form::close() }}
        </div>
    </div>
@stop