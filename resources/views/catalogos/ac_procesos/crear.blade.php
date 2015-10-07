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
            <a href="{{ URL::to('catalogos/procesos_ac') }}" class="btn btn-default btn-sm  pull-right" style="margin-right:5px; "><i class="icon-share-alt icon-black"></i> Cancelar</a>
            <p style="font-size: medium;"><i class="fa fa-database"></i> Catálogos / <strong>Procesos de Atención Ciudadana</strong> / Crear</p>
        </header>

        <section class="scrollable wrapper">
            <div class="row">
                <div class="col-lg-12">

                    <section class="panel panel-warning">
                        <header class="panel-heading font-bold"> Crear Registro </header>
                        <div class="panel-body">
                            <div class="bs-example form-horizontal">

                                {!! Form::open(array('url' => 'catalogos/procesos_ac/grabar_nuevo', 'id' => 'frmMain')) !!}


                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Unidad:</label>
                                    <div class="col-lg-10">
                                        {!! Form::select('id_departamento', $id_departamento, Input::old('id_departamento') ? Input::old('id_departamento') : null, array('class' => 'form-control', 'data-required' => 'true', 'id' => 'id_departamento')) !!}
                                        <span class="help-block m-b-none" style="margin-top: -5px; font-size: 11px;">Unidad encargada de la resolución del trámite</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Caso:</label>
                                    <div class="col-lg-10">
                                        {!! $id_caso !!}
                                        <span class="help-block m-b-none" style="margin-top: -5px; font-size: 11px;">Taxonomía de Procesos de Atención Ciudadana</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Denominaci&oacute;n:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('denominacion', Input::old('denominacion') ? Input::old('denominacion') : '', array('class' => 'form-control', 'data-required' => 'true')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Base Legal:</label>
                                    <div class="col-lg-10">
                                        {!! Form::textarea('base_legal', Input::old('base_legal') ? Input::old('base_legal') : '', array('class' => 'form-control', 'data-required' => 'true')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Propósito:</label>
                                    <div class="col-lg-10">
                                        {!! Form::textarea('proposito', Input::old('proposito') ? Input::old('proposito') : '', array('class' => 'form-control', 'data-required' => 'true')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Tiempo:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('tiempo', Input::old('tiempo') ? Input::old('tiempo') : '', array('class' => 'form-control', 'data-required' => 'true', 'data-type' => 'digits')) !!}
                                        <span class="help-block m-b-none" style="margin-top: -5px; font-size: 11px;">Tiempo máximo en días para resolver el procesos</span>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <div class="checkbox i-checks">
                                            <label> <input name="requiere_caso_snapChk" id="requiere_caso_snapChk" type="checkbox" data-multiple="requiere_caso_snapChk"><i></i> Requiere Nivel Educativo (SNAP) </label>
                                        </div>
                                        {!! Form::hidden('requiere_caso_snap', '0', array('id' => 'requiere_caso_snap')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <div class="checkbox i-checks">
                                            <label> <input name="incluir_matriz_snapChk" id="incluir_matriz_snapChk" type="checkbox" data-multiple="incluir_matriz_snapChk"><i></i> Incluir en Matriz SNAP </label>
                                        </div>
                                        {!! Form::hidden('incluir_matriz_snap', '0', array('id' => 'incluir_matriz_snap')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <div class="checkbox i-checks">
                                            <label> <input name="activo_recepcionChk" id="activo_recepcionChk" type="checkbox" data-multiple="activo_recepcion"><i></i> Activo (Recepción Trámites)</label>
                                        </div>
                                        {!! Form::hidden('activo_recepcion', '0', array('id' => 'activo_recepcion')) !!}
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

            $('#id_departamento', this).chosen('destroy').chosen();
            $('#id_caso', this).chosen('destroy').chosen();


            $('#requiere_caso_snapChk').change(function() {
                if($(this).is(":checked")) { $('#requiere_caso_snap').val('1'); }else{ $('#requiere_caso_snap').val('0'); }
            });
            $('#incluir_matriz_snapChk').change(function() {
                if($(this).is(":checked")) { $('#incluir_matriz_snap').val('1'); }else{ $('#incluir_matriz_snap').val('0'); }
            });
            $('#activo_recepcionChk').change(function() {
                if($(this).is(":checked")) { $('#activo_recepcion').val('1'); }else{ $('#activo_recepcion').val('0'); }
            });

        });


    </script>


@stop