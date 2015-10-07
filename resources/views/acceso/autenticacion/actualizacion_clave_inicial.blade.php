@extends('layouts.plantilla_autenticacion')



@section('content')

    <div class="col-md-12 m-t-lg" style="margin-top: 40px;">
        <section class="panel bg-light lt" >
            <header class="panel-heading bg bg-primary lt text-center h5"> Actualización de Clave de Acceso</header>
            <div class="panel-body b-l b-r b-b">

                <div class="bs-example form-horizontal col-md-8 col-md-offset-2">
                    <h5 style="margin-bottom: 35px;">Estimado usuario, es necesario que actualice su clave de acceso antes de iniciar sesión:</h5>
                    {!! Form::open(array('url' => 'acceso/grabar_actualizar_clave_inicial', 'id' => 'frmAdd')) !!}

                    {!! Form::hidden('token_cambio', Crypt::encrypt($usuario->id_funcionario)) !!}
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Clave Actual:</label>
                        <div class="col-lg-8">
                            <input type="password" name="old_password" id="old_password" class="form-control" data-required="true" data-rangelength="[0,20]">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Nueva Clave:</label>
                        <div class="col-lg-8">
                            <input type="password" name="nueva_clave" id="nueva_clave" class="form-control" data-required="true"  data-minlength="6" data-rangelength="[0,20]">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Confirmar Nueva Clave:</label>
                        <div class="col-lg-8">
                            <input type="password" name="nueva_clave_confirmacion" id="nueva_clave_confirmacion" class="form-control" data-required="true" data-minlength="6" data-rangelength="[0,20]" data-equalto = "#nueva_clave">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md pull-right"><i class="fa fa-chevron-right pull-right"></i> Actualizar Clave</button>

                    {!! Form::close() !!}
                </div>

            </div>

        </section>

    </div>

@stop


@section('js_code')

    <script type="text/javascript">


        $(document).ready(function () {

            $('#frmAdd').parsley();

        });

    </script>

@stop