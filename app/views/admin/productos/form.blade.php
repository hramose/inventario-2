@extends ('admin/layout')

<?php

    if ($producto->exists):
        $form_data = array('route' => array('admin.productos.update', $producto->id), 'method' => 'PATCH');
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'admin.productos.store', 'method' => 'POST');
        $action    = 'Crear';        
    endif;

?>

@section ('title') {{ $action }} Productos @stop

@section ('content')

<h3>{{ $action }} Productos</h3>

@include ('admin/errors', array('errors' => $errors)) 

<p>
    <a href="{{ route('admin.productos.index') }}" class="btn btn-primary">Lista de productos</a>
</p>

@if ($action == 'Editar')  
{{ Form::model($producto, array('route' => array('admin.productos.destroy', $producto->id), 'method' => 'DELETE', 'role' => 'form')) }}
  <div class="row">
    <div class="form-group col-md-4">
        {{ Form::submit('Eliminar Producto', array('class' => 'btn btn-danger')) }}
    </div>
  </div>
{{ Form::close() }}
@endif

<br>


{{ Form::model($producto, $form_data, array('role' => 'form')) }}

    <div class="row">
    	
        <div class="form-group col-md-4">
            {{ Form::label('nombre', 'Nombre') }}
            {{ Form::text('nombre', null, array('placeholder' => 'Nombre', 'class' => 'form-control')) }}
        </div>

        <div class="form-group col-md-4">
            {{ Form::label('descripcion', 'Descripción') }}
            {{ Form::text('descripcion', null, array('placeholder' => 'Descripción', 'class' => 'form-control')) }}        
        </div>

    </div>

    <br>
    {{ Form::button($action.' Producto', array('type' => 'submit', 'class' => 'btn btn-primary')) }}    
  
{{ Form::close() }}

@stop