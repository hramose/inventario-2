@extends ('admin/layout')

<?php

    if ($vehiculo->exists):
        $form_data = array('route' => array('admin.vehiculos.update', $vehiculo->id), 'method' => 'PATCH');
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'admin.vehiculos.store', 'method' => 'POST');
        $action    = 'Crear';        
    endif;

?>

@section ('title') {{ $action }} Vehiculos @stop

@section ('content')

<h3>{{ $action }} Vehiculos</h3>

@include ('admin/errors', array('errors' => $errors)) 

<p>
    <a href="{{ route('admin.vehiculos.index') }}" class="btn btn-primary">Lista de vehiculos</a>
</p>

@if ($action == 'Editar')  
{{ Form::model($vehiculo, array('route' => array('admin.vehiculos.destroy', $vehiculo->id), 'method' => 'DELETE', 'role' => 'form')) }}
  <div class="row">
    <div class="form-group col-md-4">
        {{ Form::submit('Eliminar Vehiculo', array('class' => 'btn btn-danger')) }}
    </div>
  </div>
{{ Form::close() }}
@endif

<br>


{{ Form::model($vehiculo, $form_data, array('role' => 'form')) }}

    <div class="row">
        <div class="form-group col-md-4">
            {{ Form::label('nombre', 'Nombre') }}
            {{ Form::text('nombre', null, array('placeholder' => 'Nombre', 'class' => 'form-control')) }}
        </div>

        <div class="form-group col-md-4">
            {{ Form::label('direccion', 'Encargado') }}
            {{ Form::text('direccion', null, array('placeholder' => 'Encargado', 'class' => 'form-control')) }}        
        </div>
        
        <div class="form-group col-md-4">
            {{ Form::label('fono', 'Teléfono') }}
            {{ Form::text('fono', null, array('placeholder' => 'Teléfono', 'class' => 'form-control')) }}        
        </div>

    </div>

    <br>
    {{ Form::button($action.' Vehiculo', array('type' => 'submit', 'class' => 'btn btn-primary')) }}    
  
{{ Form::close() }}

@stop