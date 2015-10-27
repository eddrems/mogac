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
            <a href="javascript:void(0);" class="btn btn-warning btn-sm  pull-right" style="margin-right:5px; " onclick="$('#frmMain').submit();"><i class="icon-ok icon-white"></i> Ingresar</a>
            <a href="{{ URL::to('catalogos/zonas') }}" class="btn btn-default btn-sm  pull-right" style="margin-right:5px; "><i class="icon-share-alt icon-black"></i> Cancelar</a>
            <p style="font-size: medium;"><i class="fa fa-database"></i> Catálogos / <strong>Zonas</strong> / Crear</p>
        </header>

        <section class="scrollable wrapper">
            <div class="row">
                <div class="col-lg-12">

                    <section class="panel panel-warning">
                        <header class="panel-heading font-bold"> Crear Registro </header>
                        <div class="panel-body">
                            <div class="bs-example form-horizontal">

                                {!! Form::open(array('url' => 'catalogos/zonas/grabar_nuevo', 'id' => 'frmMain')) !!}

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Código:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('codigoSemplades', Input::old('codigoSemplades') ? Input::old('codigoSemplades') : '', array('class' => 'form-control', 'data-required' => 'true')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Denominaci&oacute;n:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('denominacion', Input::old('denominacion') ? Input::old('denominacion') : '', array('class' => 'form-control', 'data-required' => 'true')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Denominaci&oacute;n Institucional:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('denominacion_institucional', Input::old('denominacion_institucional') ? Input::old('denominacion_institucional') : '', array('class' => 'form-control', 'data-required' => 'true')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Composici&oacute;n:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('composicion', Input::old('composicion') ? Input::old('composicion') : '', array('class' => 'form-control', 'data-required' => 'true')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Logo Certificaci&oacute;n:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('logo_certificacion', Input::old('logo_certificacion') ? Input::old('logo_certificacion') : '', array('class' => 'form-control', 'data-required' => 'true')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Número Certificaci&oacute;n:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('numero_certificacion', Input::old('numero_certificacion') ? Input::old('numero_certificacion') : '', array('class' => 'form-control', 'data-required' => 'true')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Pie Página Certificaci&oacute;n:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('pie_pagina_certificacion', Input::old('pie_pagina_certificacion') ? Input::old('pie_pagina_certificacion') : '', array('class' => 'form-control', 'data-required' => 'true')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Top Logo:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('logo_top', Input::old('logo_top') ? Input::old('logo_top') : '', array('class' => 'form-control', 'data-required' => 'true')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Top Left:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('logo_left', Input::old('logo_left') ? Input::old('logo_left') : '', array('class' => 'form-control', 'data-required' => 'true')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Top Número:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('numero_top', Input::old('numero_top') ? Input::old('numero_top') : '', array('class' => 'form-control', 'data-required' => 'true')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Width Número:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('numero_width', Input::old('numero_width') ? Input::old('numero_width') : '', array('class' => 'form-control', 'data-required' => 'true')) !!}
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Logo Scale</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('logo_scale', Input::old('logo_scale') ? Input::old('logo_scale') : '', array('class' => 'form-control', 'data-required' => 'true')) !!}
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

            $('#id_servicio', this).chosen('destroy').chosen();


        });


    </script>


@stop