@extends ('admin/layout')

<?php

    if ($user->exists):
        $form_data = array('route' => array('admin.users.update', $user->id), 'method' => 'PATCH');
        $action    = 'Editar';
    else:
        $form_data = array('route' => 'admin.users.store', 'method' => 'POST');
        $action    = 'Crear';        
    endif;

?>

@section ('title') {{ $action }} Usuarios @stop

@section ('content')

<h3>{{ $action }} Usuarios</h3>

@include ('admin/errors', array('errors' => $errors)) 

<p>
    <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Lista de Usuarios</a>
</p>

@if ($action == 'Editar')  
{{ Form::model($user, array('route' => array('admin.users.destroy', $user->id), 'method' => 'DELETE', 'role' => 'form')) }}
  <div class="row">
    <div class="form-group col-md-4">
        {{ Form::submit('Eliminar Usuario', array('class' => 'btn btn-danger')) }}
    </div>
  </div>
{{ Form::close() }}
@endif

<br>


{{ Form::model($user, $form_data, array('role' => 'form')) }}

    <div class="row">
        <div class="form-group col-md-4">
            {{ Form::label('email', 'Dirección de E-mail') }}
            {{ Form::text('email', null, array('placeholder' => 'Introduce tu E-mail', 'class' => 'form-control')) }}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('full_name', 'Nombre completo') }}
            {{ Form::text('full_name', null, array('placeholder' => 'Introduce tu nombre y apellido', 'class' => 'form-control')) }}        
        </div>

        <div class="form-group col-md-4">
            {{ Form::label('username', 'Nombre de usuario') }}
            {{ Form::text('username', null, array('placeholder' => 'Introduce tu nombre de usuario', 'class' => 'form-control')) }}        
        </div>
    </div>
    
    <div class="row">
        <div class="form-group col-md-4">
            {{ Form::label('password', 'Contraseña') }}
            {{ Form::password('password', array('class' => 'form-control')) }}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('password_confirmation', 'Confirmar contraseña') }}
            {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
        </div>
    </div>

    <br>
    {{ Form::button($action.' Usuario', array('type' => 'submit', 'class' => 'btn btn-primary')) }}    
  
{{ Form::close() }}

@stop