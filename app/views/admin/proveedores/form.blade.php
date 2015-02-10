@extends ('admin/layout')

<?php

    if ($proveedor->exists):
        $form_data = array('route' => array('admin.proveedores.update', $proveedor->id), 'method' => 'PATCH');
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'admin.proveedores.store', 'method' => 'POST');
        $action    = 'Crear';        
    endif;

?>

@section ('title') {{ $action }} Proveedores @stop

@section ('content')

<h3>{{ $action }} Proveedores</h3>

@include ('admin/errors', array('errors' => $errors)) 

<p>
    <a href="{{ route('admin.proveedores.index') }}" class="btn btn-primary">Lista de Proveedores</a>
</p>

@if ($action == 'Editar')  
{{ Form::model($proveedor, array('route' => array('admin.proveedores.destroy', $proveedor->id), 'method' => 'DELETE', 'role' => 'form')) }}
  <div class="row">
    <div class="form-group col-md-4">
        {{ Form::submit('Eliminar Proveedor', array('class' => 'btn btn-danger')) }}
    </div>
  </div>
{{ Form::close() }}
@endif

<br>


{{ Form::model($proveedor, $form_data, array('role' => 'form')) }}

    <div class="row">
        <div class="form-group col-md-4">
            {{ Form::label('nombre', 'Nombre') }}
            {{ Form::text('nombre', null, array('placeholder' => 'Nombre', 'class' => 'form-control')) }}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('fono', 'Teléfono') }}
            {{ Form::text('fono', null, array('placeholder' => 'Teléfono', 'class' => 'form-control')) }}        
        </div>

        <div class="form-group col-md-4">
            {{ Form::label('direccion', 'Dirección') }}
            {{ Form::text('direccion', null, array('placeholder' => 'Dirección', 'class' => 'form-control')) }}        
        </div>
    </div>

    <br>
    {{ Form::button($action.' Proveedor', array('type' => 'submit', 'class' => 'btn btn-primary')) }}    
  
{{ Form::close() }}

@stop