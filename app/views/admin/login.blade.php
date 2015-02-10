@extends ('admin/layout')

@section ('title') Login | Sistema Inventario @stop

@section ('content')

    {{-- Preguntamos si hay algún mensaje de error y si hay lo mostramos  --}}
        @if(Session::has('mensaje_error'))
        	<div class="alert alert-warning">
        		{{ Session::get('mensaje_error') }}
        	</div>
            
        @endif


    {{ Form::open(array('url' => 'admin/login')) }}

	<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Ingresar</div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>                                     
                						{{ Form::text('username', Input::old('username'), array('placeholder' => 'user', 'class' => 'form-control')); }}
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                						{{ Form::password('password', array('placeholder' => 'password', 'class' => 'form-control')); }}
                                    </div>
                                    

                                
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label class='rememberme'>
                                          {{ Form::checkbox('rememberme', true) }} Recordar
                                        </label>
                                      </div>
                                    </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      {{ Form::submit('Enviar', array('class' => 'btn btn-success')) }}
                                    </div>
                                </div> 
                            </form>     



                        </div>                     
                    </div>  
        </div>

    {{ Form::close() }}

@stop