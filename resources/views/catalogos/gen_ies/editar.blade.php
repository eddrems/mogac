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
            <a href="{{ URL::to('catalogos/ies') }}" class="btn btn-default btn-sm  pull-right" style="margin-right:5px; "><i class="icon-share-alt icon-black"></i> Regresar</a>
            <p style="font-size: medium;"><i class="fa fa-database"></i> Catálogos / <strong>IEs</strong> / Editar</p>
        </header>

        <section class="scrollable wrapper">
            <div class="row">
                <div class="col-lg-12">

                    <section class="panel panel-warning">
                        <header class="panel-heading font-bold"> Editar: {!! $registro->denominacion !!}</header>
                        <div class="panel-body">
                            <div class="bs-example form-horizontal">


                                {!! Form::open(array('url' => 'catalogos/ies/grabar_actualizar', 'id' => 'frmMain')) !!}

                                {!! Form::hidden('id', Crypt::encrypt($registro->id_institucion_educativa)) !!}

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Circuito:</label>
                                    <div class="col-lg-10">
                                        {!! $circuitos !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Ubicación:</label>
                                    <div class="col-lg-10">
                                        {!! Form::select('id_parroquia', $parroquias, Input::old('id_parroquia') ? Input::old('id_parroquia') : $registro->id_parroquia, array('class' => 'form-control', 'data-required' => 'true', 'id' => 'id_parroquia')) !!}

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">AMIE:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('codigo_amie', Input::old('codigo_amie') ? Input::old('codigo_amie') : $registro->codigo_amie, array('class' => 'form-control', 'data-required' => 'true', 'autocomplete' => 'off')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Denominaci&oacute;n:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('denominacion', Input::old('denominacion') ? Input::old('denominacion') : $registro->denominacion, array('class' => 'form-control', 'data-required' => 'true', 'autocomplete' => 'off')) !!}
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