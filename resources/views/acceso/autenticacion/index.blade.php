@extends('layouts.plantilla_autenticacion')



@section('content')

    <div class="col-md-6 col-md-offset-3 m-t-lg" style="margin-top: 40px;">
        <section class="panel bg-light lt" >
            <header class="panel-heading bg bg-primary lt text-center">Inicio de Sesión</header>
            {!! Form::open(array('url' => 'acceso/iniciar_sesion', 'id' => 'frmLogin', 'class' => 'panel-body')) !!}
            @if (Session::has('message_actualizacion'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
                    <p>{{ Session::get('message_actualizacion') }}</p>
                </div>
            @endif
            <div class="form-group">
                <label class="control-label">Usuario</label>
                {!! Form::text('identificacion',  '', array('class' => 'form-control', 'data-required' => 'true', 'placeholder' => 'usuario', 'data-rangelength' => '[0,13]', 'autocomplete' => 'off')) !!}
            </div>
            <div class="form-group">
                <label class="control-label">Clave de Acceso</label>
                <input type="password" name="claveacceso" id="claveacceso" placeholder="clave" class="form-control" data-required="true" data-rangelength="[0,20]">
            </div>

            <button type="submit" class="btn btn-block btn-primary">Iniciar Sesión</button>
            <p class="text-muted text-center" style="margin-top: 10px; margin-bottom: 0px;"><small><a href="{{ url('acceso/recuperacion') }}">Olvidó su Clave de Acceso?</a></small></p>
            {!! Form::close() !!}
        </section>

    </div>

@stop


@section('js_code')

    <script type="text/javascript">


        $(document).ready(function () {

            $('#frmLogin').parsley();

        });

    </script>

@stop