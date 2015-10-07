@extends('layouts.plantilla_autenticacion')



@section('content')

    <div class="col-md-12 m-t-lg" style="margin-top: 40px;">
        <section class="panel panel-primary bg-light lt" >
            <header class="panel-heading text-center h5"> Actualización de Datos Personales</header>
            <div class="panel-body b-l b-r b-b">

                <div class="bs-example form-horizontal">

                    <div class="alert alert-warning alert-block">
                        <h5 style="font-weight: bold;"><i class="fa fa-bell-alt"></i>Estimado Usuario:</h5>
                        <p>Por favor revise su información de contacto: correo electrónico, teléfonos, dirección, género, estado civi. Si encuentra alguna inconsistencia puede corregirla a través de éste formulario.</p>
                        <p style="font-weight: bold;" class="m-t">Si existe alguna inconsistecia en su Cargo, Undiad Departamental o número de cédula gestione el cambio con su Director Distrital. </p>
                    </div>


                    {!! Form::open(array('url' => 'acceso/grabar_actualizar_info_personal', 'id' => 'frmAdd')) !!}

                    {!! Form::hidden('token_cambio', Crypt::encrypt($usuario->id_funcionario)) !!}
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Distrito:</label>
                        <div class="col-lg-10">
                            {!! Form::text('dt_distrito', $usuario->distrito->denominacion_institucional, array('class' => 'form-control', 'readonly' => 'true')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Departamento:</label>
                        <div class="col-lg-10">
                            {!! Form::text('dt_depa', $usuario->departamento->denominacion, array('class' => 'form-control', 'readonly' => 'true')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Cargo:</label>
                        <div class="col-lg-10">
                            {!! Form::text('dt_cargo', $usuario->cargo->denominacion, array('class' => 'form-control', 'readonly' => 'true')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Identificaci&oacute;n:</label>
                        <div class="col-lg-10">
                            {!! Form::text('dt_identificacion', $usuario->identificacion, array('class' => 'form-control', 'readonly' => 'true')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Apellidos:</label>
                        <div class="col-lg-10">
                            {!! Form::text('dt_apellidos', $usuario->apellidos, array('class' => 'form-control', 'readonly' => 'true')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nombres:</label>
                        <div class="col-lg-10">
                            {!! Form::text('dt_nombres', $usuario->nombres, array('class' => 'form-control', 'readonly' => 'true')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">G&eacute;nero:</label>
                        <div class="col-lg-10">
                            {!! Form::select('id_genero', $generos, $usuario->id_genero, array('class' => 'form-control', 'data-required' => 'true')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Estado Civil:</label>
                        <div class="col-lg-10">
                            {!! Form::select('id_estado_civil', $estados_civiles, $usuario->id_estado_civil, array('class' => 'form-control', 'data-required' => 'true')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Correo Electr&oacute;nico:</label>
                        <div class="col-lg-10">
                            {!! Form::text('correo', $usuario->correo, array('class' => 'form-control', 'data-required' => 'true', 'data-type' => 'email')) !!}
                            <span class="help-block m-b-none text-dark" style="font-size: 11px; font-weight: bold;">Por favor asegúrese que la dirección de correo electrónica sea la correcta, pues a través de ella se realizarán procesos como recuperación de claves olvidadas y comunicaciones en general</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Direcci&oacute;n:</label>
                        <div class="col-lg-10">
                            {!! Form::text('direccion', $usuario->direccion, array('class' => 'form-control', 'data-required' => 'true', 'data-minlength'=>'5')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Telefono M&oacute;vil:</label>
                        <div class="col-lg-10">
                            {!! Form::text('telefono_movil', $usuario->telefono_movil, array('class' => 'form-control', 'data-type' => 'digits', 'data-minlength'=>'10')) !!}
                            <span class="help-block m-b-none text-dark" style="font-size: 11px; font-weight: bold;">Ejemplo: 0994578980</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Telefono Fijo:</label>
                        <div class="col-lg-10">
                            {!! Form::text('telefono_fijo', $usuario->telefono_fijo, array('class' => 'form-control', 'data-type' => 'digits', 'data-required' => 'true')) !!}
                            <span class="help-block m-b-none text-dark" style="font-size: 11px; font-weight: bold;">Ejemplo: 074173159</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md pull-right"><i class="fa fa-chevron-right pull-right"></i> Actualizar Información</button>

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