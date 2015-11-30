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
            <a href="{{ URL::to('catalogos/tramites_estado') }}" class="btn btn-default btn-sm  pull-right" style="margin-right:5px; "><i class="icon-share-alt icon-black"></i> Regresar</a>
            <p style="font-size: medium;"><i class="fa fa-database"></i> Catálogos / <strong>Estados de Trámites (Bandejas)</strong> / Editar </p>
        </header>

        <section class="scrollable wrapper">
            <div class="row">
                <div class="col-lg-12">

                    <section class="panel panel-warning">
                        <header class="panel-heading font-bold"> Editar: {!! strtoupper($registro->denominacion) !!} </header>
                        <div class="panel-body">
                            <div class="bs-example form-horizontal">

                                {!! Form::open(array('url' => 'catalogos/tramites_estado/grabar_actualizar', 'id' => 'frmMain')) !!}

                                {!! Form::hidden('id', Crypt::encrypt($registro->id_estado_tramite)) !!}

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Orden:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('orden', Input::old('orden') ? Input::old('orden') : $registro->orden, array('class' => 'form-control', 'data-required' => 'true', 'data-type' => 'number', 'autocomplete' => 'off')) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Denominaci&oacute;n:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('denominacion', Input::old('denominacion') ? Input::old('denominacion') : $registro->denominacion, array('class' => 'form-control', 'data-required' => 'true', 'autocomplete' => 'off')) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">CSS COLOR:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('css_color', Input::old('css_color') ? Input::old('css_color') : $registro->css_color, array('class' => 'form-control', 'data-required' => 'true', 'autocomplete' => 'off')) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">CSS LABEL CLASS:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('css_label_class', Input::old('css_label_class') ? Input::old('css_label_class') : $registro->css_label_class, array('class' => 'form-control', 'data-required' => 'true', 'autocomplete' => 'off')) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Abreviatura:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('letra', Input::old('letra') ? Input::old('letra') : $registro->letra, array('class' => 'form-control', 'data-required' => 'true', 'autocomplete' => 'off')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <div class="checkbox i-checks">
                                            @if ($registro->permite_edicion == 0)
                                                <label> <input name="permite_edicionChk" id="permite_edicionChk" type="checkbox" data-multiple="incluir_matriz_snapChk"><i></i> Permite Edición </label>
                                            @else
                                                <label> <input name="permite_edicionChk" id="permite_edicionChk" type="checkbox" data-multiple="incluir_matriz_snapChk" checked><i></i> Permite Edición </label>
                                            @endif
                                        </div>
                                        {!! Form::hidden('permite_edicion', $registro->permite_edicion , array('id' => 'permite_edicion')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <div class="checkbox i-checks">
                                            @if ($registro->proceso_terminado == 0)
                                                <label> <input name="proceso_terminadoChk" id="proceso_terminadoChk" type="checkbox" data-multiple="incluir_matriz_snapChk"><i></i> Proceso Terminado </label>
                                            @else
                                                <label> <input name="proceso_terminadoChk" id="proceso_terminadoChk" type="checkbox" data-multiple="incluir_matriz_snapChk" checked><i></i> Proceso Terminado </label>
                                            @endif
                                        </div>
                                        {!! Form::hidden('proceso_terminado', $registro->proceso_terminado , array('id' => 'proceso_terminado')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <div class="checkbox i-checks">
                                            @if ($registro->permite_cambio_manual == 0)
                                                <label><input name="permite_cambio_manualChk" id="permite_cambio_manualChk" type="checkbox" data-multiple="incluir_matriz_snapChk"><i></i> Permite Cambio Manual </label>
                                            @else
                                                <label><input name="permite_cambio_manualChk" id="permite_cambio_manualChk" type="checkbox" data-multiple="incluir_matriz_snapChk" checked><i></i> Permite Cambio Manual </label>
                                            @endif
                                        </div>
                                        {!! Form::hidden('permite_cambio_manual', $registro->permite_cambio_manual , array('id' => 'permite_cambio_manual')) !!}
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <div class="checkbox i-checks">
                                            <div class="checkbox i-checks">
                                                @if ($registro->permite_traslado_distrito == 0)
                                                    <label> <input name="permite_traslado_distritoChk" id="permite_traslado_distritoChk" type="checkbox" data-multiple="incluir_matriz_snapChk"><i></i> Permite Traslado Inter-Distrital </label>
                                                @else
                                                    <label> <input name="permite_traslado_distritoChk" id="permite_traslado_distritoChk" type="checkbox" data-multiple="incluir_matriz_snapChk" checked><i></i> Permite Traslado Inter-Distrital </label>
                                                @endif
                                        </div>
                                        {!! Form::hidden('permite_traslado_distrito', $registro->permite_traslado_distrito, array('id' => 'permite_traslado_distrito')) !!}
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


            $('#permite_edicionChk').change(function() {
                if($(this).is(":checked")) { $('#permite_edicion').val('1'); }else{ $('#permite_edicion').val('0'); }
            });
            $('#proceso_terminadoChk').change(function() {
                if($(this).is(":checked")) { $('#proceso_terminado').val('1'); }else{ $('#proceso_terminado').val('0'); }
            });
            $('#permite_cambio_manualChk').change(function() {
                if($(this).is(":checked")) { $('#permite_cambio_manual').val('1'); }else{ $('#permite_cambio_manual').val('0'); }
            });
            $('#permite_traslado_distritoChk').change(function() {
                if($(this).is(":checked")) { $('#permite_traslado_distrito').val('1'); }else{ $('#permite_traslado_distrito').val('0'); }
            });

        });


    </script>


@stop