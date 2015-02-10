@extends ('admin/layout')

@section ('title') Proveedor {{ $proveedor->nombre }} @stop

@section ('content')


    <h3>Proveedor</h3>

    <br>

    <p>
        <a href="{{ route('admin.proveedores.index') }}" class="btn btn-primary">Volver a la Lista</a>
        <a href="{{ route('admin.proveedores.create') }}" class="btn btn-primary">Crear un nuevo Proveedor</a>
    </p>

    <br>
  
    <div class="panel panel-info">

        <div class="panel-heading">{{ $proveedor->nombre }}</div>
        <div class="panel-body">

            <div class="input-group">
                <span class="input-group-addon" >Teléfono</span>
                <span class="form-control" >{{ $proveedor->fono }}</span>
            </div>

            <div class="input-group">
                <span class="input-group-addon" >Dirección</span>
                <span class="form-control" >{{ $proveedor->direccion }}</span>
            </div>

            <div class="input-group">
                <span class="input-group-addon" >Vigente</span>
                <span class="form-control" >{{ $proveedor->estado }}</span>
            </div>

        </div>

        <div class="panel-footer">
            <a href="{{ route('admin.proveedores.edit', $proveedor->id) }}" class="btn btn-primary">Editar</a>
            <br><br>
            {{ Form::model($proveedor, array('route' => array('admin.proveedores.destroy', $proveedor->id), 'method' => 'DELETE'), array('role' => 'form')) }}
                {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
            {{ Form::close() }}
        </div>
    </div>
@stop