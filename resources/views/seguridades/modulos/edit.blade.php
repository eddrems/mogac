@extends('layouts.plantilla_ui_general')


@section('content')

    <div class="modal" id="loadingPanel" tabindex="-1" role="dialog">
        <div class="modal-dialog" style="width:60%">
            <div class="modal-content">
                <div class="modal-header" style="text-align:center; ">Cargarndo...<br /><strong>Gracias por su gentil espera!</strong></div>
                <div class="modal-body"><div class="progress progress progress-striped active" style="margin-bottom:0px;"> <div class="progress-bar progress-bar-info" data-toggle="tooltip" data-original-title="30%" style="width: 100%"></div> </div></div>
            </div>
        </div>
    </div>
    <!-- Loading Panel -->

    <section class="vbox">
        <header class="header b-b bg-white hidden-print">
            <a href="javascript:void(0);" class="btn btn-warning btn-sm  pull-right" style="margin-right:5px; " onclick="$('#frmMain').submit();"><i class="icon-ok icon-white"></i> Actualizar</a>
            <a href="{{ URL::to('seguridades/modulos/detalles/listar') . '/' . Crypt::encrypt($agrupador->id_subsistema) }}" class="btn btn-default btn-sm  pull-right" style="margin-right:5px; "><i class="icon-share-alt icon-black"></i> Regresar</a>
            <p style="font-size: medium;"><i class="fa fa-unlock"></i> Seguridades / <strong> {!! $agrupador->descripcion !!} </strong> / Detalles / Editar </p>
        </header>

        <section class="scrollable wrapper">
            <div class="row">
                <div class="col-lg-12">

                    <section class="panel panel-warning">
                        <header class="panel-heading font-bold"> Editar: {!! strtoupper($registro->descripcion) !!} </header>
                        <div class="panel-body">
                            <div class="bs-example form-horizontal">

                                {!! Form::open(array('url' => 'seguridades/modulos/detalles/grabar_actualizar', 'id' => 'frmMain')) !!}

                                {!! Form::hidden('id', Crypt::encrypt($registro->id_modulo)) !!}
                                {!! Form::hidden('id_subsistema', $agrupador->id_subsistema) !!}


                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Orden:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('orden', Input::old('orden') ? Input::old('orden') : $registro->orden, array('class' => 'form-control', 'data-type' => 'digits', 'data-required' => 'true', 'autocomplete' => 'off')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Denominaci&oacute;n:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('descripcion', Input::old('descripcion') ? Input::old('descripcion') : $registro->descripcion, array('class' => 'form-control', 'data-required' => 'true', 'autocomplete' => 'off')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Texto:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('texto', Input::old('texto') ? Input::old('texto') : $registro->texto, array('class' => 'form-control', 'data-required' => 'true', 'autocomplete' => 'off')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Action:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('accion', Input::old('accion') ? Input::old('accion') : $registro->accion, array('class' => 'form-control', 'autocomplete' => 'off')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Controller:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('controlador', Input::old('controlador') ? Input::old('controlador') : $registro->controlador, array('class' => 'form-control', 'data-required' => 'true', 'autocomplete' => 'off')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Icono:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('icon', Input::old('icon') ? Input::old('icon') : $registro->icon, array('class' => 'form-control', 'data-required' => 'true', 'autocomplete' => 'off')) !!}
                                    </div>
                                </div>

                                {!! Form::close()!!}

                            </div>
                        </div>
                    </section>


                </div>
            </div>

        </section>


    </section>

@stop

@section('js_code')

    <script type="text/javascript">

        var isLoading = false;

        $(document).ready(function () {

            $("#nav").addClass("nav-xs");

            $('#frmMain').parsley();


        });


    </script>


@stop