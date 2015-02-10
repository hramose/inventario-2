@extends ('admin/layout')

<?php

    if ($cliente->exists):
        $form_data = array('route' => array('admin.clientes.update', $cliente->id), 'method' => 'PATCH');
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'admin.clientes.store', 'method' => 'POST');
        $action    = 'Crear';        
    endif;

?>

@section ('title') {{ $action }} Clientes @stop

@section ('content')

<h3>{{ $action }} Clientes</h3>

@include ('admin/errors', array('errors' => $errors)) 

<p>
    <a href="{{ route('admin.clientes.index') }}" class="btn btn-primary">Lista de Clientes</a>
</p>

@if ($action == 'Editar')  
{{ Form::model($cliente, array('route' => array('admin.clientes.destroy', $cliente->id), 'method' => 'DELETE', 'role' => 'form')) }}
  <div class="row">
    <div class="form-group col-md-4">
        {{ Form::submit('Eliminar Cliente', array('class' => 'btn btn-danger')) }}
    </div>
  </div>
{{ Form::close() }}
@endif

<br>


{{ Form::model($cliente, $form_data, array('role' => 'form')) }}

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
    {{ Form::button($action.' Cliente', array('type' => 'submit', 'class' => 'btn btn-primary')) }}    
  
{{ Form::close() }}

@stop