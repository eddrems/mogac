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
            <a href="{{ URL::to('catalogos/distritos') }}" class="btn btn-default btn-sm  pull-right" style="margin-right:5px; "><i class="icon-share-alt icon-black"></i> Cancelar</a>
            <p style="font-size: medium;"><i class="fa fa-database"></i> Catálogos / <strong>Distritos</strong> / Crear</p>
        </header>

        <section class="scrollable wrapper">
            <div class="row">
                <div class="col-lg-12">

                    <section class="panel panel-warning">
                        <header class="panel-heading font-bold"> Crear Registro </header>
                        <div class="panel-body">
                            <div class="bs-example form-horizontal">

                                {!! Form::open(array('url' => 'catalogos/distritos/grabar_nuevo', 'id' => 'frmMain')) !!}

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Zona:</label>
                                    <div class="col-lg-10">
                                        {!! Form::select('id_zona', $zonas, Input::old('id_zona') ? Input::old('id_zona') : null, array('class' => 'form-control', 'data-required' => 'true', 'id' => 'id_zona')) !!}

                                    </div>
                                </div>

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
                                        {!! Form::textarea('composicion', Input::old('composicion') ? Input::old('composicion') : '', array('class' => 'form-control', 'rows' => '4', 'data-required' => 'true')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Parroquia:</label>
                                    <div class="col-lg-10">
                                        {!! Form::select('id_parroquia', $parroquias, Input::old('id_parroquia') ? Input::old('id_parroquia') : null, array('class' => 'form-control', 'data-required' => 'true', 'id' => 'id_parroquia')) !!}

                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Direcci&oacute;n:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('direccion', Input::old('composicion') ? Input::old('direccion') : '', array('class' => 'form-control', 'data-required' => 'true')) !!}
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



@section('Dependencias_CSS')

@stop

@section('Dependencias_JS')
@stop

@section('js_code')

    <script type="text/javascript">

        var isLoading = false;

        $(document).ready(function () {



            $("#nav").addClass("nav-xs");

            $('#frmMain').parsley();

            $('#id_zona', this).chosen('destroy').chosen();
            $('#id_parroquia', this).chosen('destroy').chosen();


        });


    </script>


@stop