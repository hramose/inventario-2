@extends ('admin/layout')

@section ('title') Registro Compra {{ $compra->id }} @stop

@section ('content')


    <h3>Registro Compra</h3>

    <br>

    <p>
        <a href="{{ route('admin.compras.index') }}" class="btn btn-primary">Volver a la Lista</a>
        <a href="{{ route('admin.compras.create') }}" class="btn btn-primary">Crear registro Compra</a>
    </p>

    <br>
  
    <div class="panel panel-info">

        <div class="panel-heading">LOTE N° {{ $compra->id }}</div>
        <div class="panel-body">
			
			<div class="input-group">
                <span class="input-group-addon" >Producto</span>
                <span class="form-control" >{{ $compra->producto->nombre }}</span>
            </div>

            <div class="input-group">
                <span class="input-group-addon" >Proveedor</span>
                <span class="form-control" >{{ $compra->proveedor->nombre }}</span>
            </div>

            <div class="input-group">
                <span class="input-group-addon" >Cantidad</span>
                <span class="form-control" >{{ $compra->cantidad }}</span>
            </div>

            <div class="input-group">
                <span class="input-group-addon" >Costo Unitario</span>
                <span class="form-control" >{{ $compra->costo_unitario }}</span>
            </div>

            <div class="input-group">
                <span class="input-group-addon" >Costo Unitario IVA</span>
                <span class="form-control" >{{ $compra->costo_unitario_iva }}</span>
            </div>

            <div class="input-group">
                <span class="input-group-addon" >Costo Total</span>
                <span class="form-control" >{{ $compra->costo_total }}</span>
            </div>

            <div class="input-group">
                <span class="input-group-addon" >Costo Total IVA</span>
                <span class="form-control" >{{ $compra->costo_total_iva }}</span>
            </div>

            <div class="input-group">
                <span class="input-group-addon" >Fecha Compra</span>
                <span class="form-control" >{{ $compra->fecha_compra }}</span>
            </div>

            <div class="input-group">
                <span class="input-group-addon" >Fecha Vencimiento</span>
                <span class="form-control" >{{ $compra->fecha_vencimiento }}</span>
            </div>

        </div>

        <div class="panel-footer">
            <a href="{{ route('admin.compras.edit', $compra->id) }}" class="btn btn-primary">Editar</a>
            <br><br>
            {{ Form::model($compra, array('route' => array('admin.compras.destroy', $compra->id), 'method' => 'DELETE'), array('role' => 'form')) }}
                {{ Form::submit('Eliminar', array('class' => 'btn btn-danger')) }}
            {{ Form::close() }}
        </div>
    </div>
@stop