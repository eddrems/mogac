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
            <a href="{{ URL::to('catalogos/circuitos') }}" class="btn btn-default btn-sm  pull-right" style="margin-right:5px; "><i class="icon-share-alt icon-black"></i> Regresar</a>
            <p style="font-size: medium;"><i class="fa fa-database"></i> Catálogos / <strong>Circuitos</strong> / Editar</p>
        </header>

        <section class="scrollable wrapper">
            <div class="row">
                <div class="col-lg-12">

                    <section class="panel panel-warning">
                        <header class="panel-heading font-bold"> Editar: {!! $registro->codigoSemplades !!}</header>
                        <div class="panel-body">
                            <div class="bs-example form-horizontal">

                                {!! Form::open(array('url' => 'catalogos/circuitos/grabar_actualizar', 'id' => 'frmMain')) !!}

                                {!! Form::hidden('id', Crypt::encrypt($registro->id_circuito)) !!}

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Distrito / Zona:</label>
                                    <div class="col-lg-10">
                                        {!! Form::select('id_distrito', $distritos, Input::old('id_distrito') ? Input::old('id_distrito') : $registro->id_distrito, array('class' => 'form-control', 'data-required' => 'true', 'id' => 'id_distrito')) !!}

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Código:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('codigoSemplades', Input::old('codigoSemplades') ? Input::old('codigoSemplades') : $registro->codigoSemplades, array('class' => 'form-control', 'data-required' => 'true')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Composici&oacute;n:</label>
                                    <div class="col-lg-10">
                                        {!! Form::textarea('composicion', Input::old('composicion') ? Input::old('composicion') : $registro->composicion, array('class' => 'form-control', 'rows' => '4', 'data-required' => 'true')) !!}
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

            $('#id_distrito', this).chosen('destroy').chosen();


        });


    </script>


@stop