@extends ('admin/layout')

<?php

    if ($dato->exists):
        $form_data = array('route' => array('admin.datos.update', $dato->id), 'method' => 'PATCH');
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'admin.datos.store', 'method' => 'POST');
        $action    = 'Crear';        
    endif;

?>

@section ('title') {{ $action }} Datos @stop

@section ('content')

<h3>{{ $action }} Datos</h3>

@include ('admin/errors', array('errors' => $errors)) 

<p>
    <a href="{{ route('admin.datos.index') }}" class="btn btn-primary">Lista de datos</a>
</p>

@if ($action == 'Editar')  
{{ Form::model($dato, array('route' => array('admin.datos.destroy', $dato->id), 'method' => 'DELETE', 'role' => 'form')) }}
  <div class="row">
    <div class="form-group col-md-4">
        <!--{{ Form::submit('Eliminar Dato', array('class' => 'btn btn-danger')) }}-->
    </div>
  </div>
{{ Form::close() }}
@endif

<br>


{{ Form::model($dato, $form_data, array('role' => 'form')) }}

    <div class="row">
        <div class="form-group col-md-4">
            {{ Form::label('nombre', 'Nombre') }}
            {{ Form::text('nombre', null, array('placeholder' => 'Nombre del dato', 'class' => 'form-control')) }}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('valor', 'Valor') }}
            {{ Form::text('valor', null, array('placeholder' => 'Valor', 'class' => 'form-control')) }}        
        </div>
    </div>

    <br>
    {{ Form::button($action.' Dato', array('type' => 'submit', 'class' => 'btn btn-primary')) }}    
  
{{ Form::close() }}

@stop