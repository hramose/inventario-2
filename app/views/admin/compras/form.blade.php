@extends ('admin/layout')

<?php

    if ($compra->exists):
        $form_data = array('route' => array('admin.compras.update', $compra->id), 'method' => 'PATCH');
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'admin.compras.store', 'method' => 'POST');
        $action    = 'Crear';        
    endif;

?>

@section ('title') {{ $action }} Compras @stop

@section ('content')

<h3>{{ $action }} Compras</h3>

@include ('admin/errors', array('errors' => $errors)) 

<p>
    <a href="{{ route('admin.compras.index') }}" class="btn btn-primary">Lista de compras</a>
</p>

@if ($action == 'Editar')  
{{ Form::model($compra, array('route' => array('admin.compras.destroy', $compra->id), 'method' => 'DELETE', 'role' => 'form')) }}
  <div class="row">
    <div class="form-group col-md-4">
        {{ Form::submit('Eliminar Cliente', array('class' => 'btn btn-danger')) }}
    </div>
  </div>
{{ Form::close() }}
@endif

<br>


{{ Form::model($compra, $form_data, array('role' => 'form')) }}

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
            {{ Form::label('fecha_compra', 'Fecha Compra') }}
            {{ Form::text('fecha_compra', null, array('placeholder' => 'Fecha Compra', 'class' => 'form-control fecha')) }}        
        </div>

        <div class="form-group  col-md-2">
            {{ Form::label('fecha_vencimiento', 'Fecha Vencimiento') }}
            {{ Form::text('fecha_vencimiento', null, array('placeholder' => 'Fecha Vencimiento', 'class' => 'form-control fecha')) }}
        </div>
    </div>

    <div class="row">

    	<div class="form-group col-md-3">
            {{ Form::label('num_factura', 'N° Factura') }}
            {{ Form::text('num_factura', null, array('placeholder' => 'N° Factura', 'class' => 'form-control')) }}        
        </div>

        <div class="form-group  col-md-3">
            {{ Form::label('num_cheque', 'N° Cheque') }}
            {{ Form::text('num_cheque', null, array('placeholder' => 'N° Cheque', 'class' => 'form-control')) }}
        </div>

        <div class="form-group col-md-3">
            {{ Form::label('banco', 'Banco') }}
            {{ Form::select('banco_id', $bancos, $select_banco, 
                array(  'class' => 'chosen-select form-control',
                        'data-placeholder' => 'Selecciona...',
                        'tabindex' => '2'
                )) 
            }}
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
    {{ Form::button($action.' Compra', array('type' => 'submit', 'class' => 'btn btn-primary')) }}    
  
{{ Form::close() }}

@stop