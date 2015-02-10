@extends ('admin/layout')

<?php

    if ($venta->exists):
        $form_data = array('route' => array('admin.ventas.update', $venta->id), 'method' => 'PATCH');
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'admin.ventas.store', 'method' => 'POST');
        $action    = 'Crear';        
    endif;

?>

@section ('title') {{ $action }} Registro de Ventas @stop

@section ('content')

<h3>{{ $action }} Registro de Ventas</h3>

@include ('admin/errors', array('errors' => $errors)) 

<p>
    <a href="{{ route('admin.ventas.index') }}" class="btn btn-primary">Lista de ventas</a>
</p>

@if ($action == 'Editar')  
{{ Form::model($venta, array('route' => array('admin.ventas.destroy', $venta->id), 'method' => 'DELETE', 'role' => 'form')) }}
  <div class="row">
    <div class="form-group col-md-4">
        {{ Form::submit('Eliminar Cliente', array('class' => 'btn btn-danger')) }}
    </div>
  </div>
{{ Form::close() }}
@endif

<br>


{{ Form::model($venta, $form_data, array('role' => 'form')) }}

    <div class="row">
        <div class="form-group col-md-3">
            {{ Form::label('producto', 'Producto') }}
            {{ Form::select('producto_id', $productos, $select_producto, 
                array(  'class' => 'chosen-select form-control',
                        'data-placeholder' => 'Selecciona...',
                        'tabindex' => '2'
                )) 
            }}
        </div>

        <div class="form-group col-md-3">
            {{ Form::label('proveedor', 'Proveedor') }}
            {{ Form::select('proveedor_id', $proveedores, $select_proveedor, 
                array(  'class' => 'chosen-select form-control',
                        'data-placeholder' => 'Selecciona...',
                        'tabindex' => '2'
                )) 
            }}
        </div>

        
    </div>


    <div class="row">

    	<div class="form-group col-xs-5 col-md-2">
            {{ Form::label('cantidad', 'Cantidad') }}
            {{ Form::text('cantidad', null, array('placeholder' => 'Cantidad', 'class' => 'form-control')) }}        
        </div>

    </div>

    <div class="row">

    	<div class="form-group col-md-2">
            {{ Form::label('fecha_venta', 'Fecha venta') }}
            {{ Form::text('fecha_venta', null, array('placeholder' => 'Fecha venta', 'class' => 'form-control fecha')) }}        
        </div>

        <div class="form-group  col-md-2">
            {{ Form::label('fecha_vencimiento', 'Fecha Vencimiento') }}
            {{ Form::text('fecha_vencimiento', null, array('placeholder' => 'Fecha Vencimiento', 'class' => 'form-control fecha')) }}
        </div>
    </div>

	<div class="row">


    	<div class="form-group col-md-3">
            {{ Form::label('costo_unitario', 'Costo Unitario') }}
            {{ Form::text('costo_unitario', null, array('placeholder' => 'Costo Unitario', 'class' => 'form-control')) }}        
        </div>

        <div class="form-group col-md-3">
            {{ Form::label('costo_unitario_iva', 'Costo Unitario con IVA') }}
            {{ Form::text('costo_unitario_iva', null, array('placeholder' => 'Costo Unitario con IVA', 'class' => 'form-control')) }}        
        </div>
    </div>

    <div class="row">
    	<div class="form-group col-md-3">
            {{ Form::label('costo_total', 'Costo Total') }}
            {{ Form::text('costo_total', null, array('placeholder' => 'Costo Total', 'class' => 'form-control')) }}        
        </div>

        <div class="form-group col-md-3">
            {{ Form::label('costo_total_iva', 'Costo Total con IVA') }}
            {{ Form::text('costo_total_iva', null, array('placeholder' => 'Costo Total con IVA', 'class' => 'form-control')) }}        
        </div>
    </div>

    

    <br>
    {{ Form::button($action.' Venta', array('type' => 'submit', 'class' => 'btn btn-primary')) }}    
  
{{ Form::close() }}

@stop