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
            <a href="{{ URL::to('seguridades/modulos') }}" class="btn btn-default btn-sm  pull-right" style="margin-right:5px; "><i class="icon-share-alt icon-black"></i> Regresar</a>
            <p style="font-size: medium;"><i class="fa fa-unlock"></i> Seguridades / <strong> Módulos del Aplicativo</strong> / Editar </p>
        </header>

        <section class="scrollable wrapper">
            <div class="row">
                <div class="col-lg-12">

                    <section class="panel panel-warning">
                        <header class="panel-heading font-bold"> Editar: {!! strtoupper($registro->denominacion) !!} </header>
                        <div class="panel-body">
                            <div class="bs-example form-horizontal">

                                {!! Form::open(array('url' => 'seguridades/modulos/grabar_actualizar', 'id' => 'frmMain')) !!}

                                {!! Form::hidden('id', Crypt::encrypt($registro->id_subsistema)) !!}



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
                                    <label class="col-lg-2 control-label">Icono:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('icon', Input::old('icon') ? Input::old('icon') : $registro->icon, array('class' => 'form-control', 'data-required' => 'true', 'autocomplete' => 'off')) !!}
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <div class="checkbox i-checks">
                                            <div class="checkbox i-checks">
                                                @if ($registro->esta_activo == 0)
                                                    <label> <input name="esta_activoChk" id="esta_activoChk" type="checkbox" data-multiple="requiere_observacionesChk"><i></i> Activo</label>
                                                @else
                                                    <label> <input name="esta_activoChk" id="esta_activoChk" type="checkbox" data-multiple="permite_traslado_distritoChk" checked><i></i> Activo</label>
                                                @endif
                                        </div>
                                        {!! Form::hidden('esta_activo', $registro->requiere_observaciones, array('id' => 'esta_activo')) !!}
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


            $('#esta_activoChk').change(function() {
                if($(this).is(":checked")) { $('#esta_activo').val('1'); }else{ $('#esta_activo').val('0'); }
            });

        });


    </script>


@stop