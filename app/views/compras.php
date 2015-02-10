@extends ('admin/layout')

@section ('title') {{ $action }} Vehiculos @stop

@section ('content')

<h3>{{ $action }} Vehiculos</h3>

@include ('admin/errors', array('errors' => $errors)) 

compra vista

@stop