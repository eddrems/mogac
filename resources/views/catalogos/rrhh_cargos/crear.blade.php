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
            <a href="{{ URL::to('catalogos/cargos_funcionarios') }}" class="btn btn-default btn-sm  pull-right" style="margin-right:5px; "><i class="icon-share-alt icon-black"></i> Cancelar</a>
            <p style="font-size: medium;"><i class="fa fa-database"></i> Catálogos / <strong> RRHH - Cargos</strong> / Crear</p>
        </header>

        <section class="scrollable wrapper">
            <div class="row">
                <div class="col-lg-12">

                    <section class="panel panel-warning">
                        <header class="panel-heading font-bold"> Crear Registro </header>
                        <div class="panel-body">
                            <div class="bs-example form-horizontal">

                                {!! Form::open(array('url' => 'catalogos/cargos_funcionarios/grabar_nuevo', 'id' => 'frmMain')) !!}


                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Denominaci&oacute;n:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('denominacion', Input::old('denominacion') ? Input::old('denominacion') : '', array('class' => 'form-control', 'data-required' => 'true', 'autocomplete' => 'off')) !!}
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <div class="checkbox i-checks">
                                            <label> <input name="aplicable_personasChk" id="aplicable_personasChk" type="checkbox" data-multiple="incluir_matriz_snapChk"><i></i> Usable En Personas</label>
                                        </div>
                                        {!! Form::hidden('aplicable_personas', '0', array('id' => 'aplicable_personas')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <div class="checkbox i-checks">
                                            <label> <input name="aplicable_funcionariosChk" id="aplicable_funcionariosChk" type="checkbox" data-multiple="incluir_matriz_snapChk"><i></i> Usable en Funcionarios</label>
                                        </div>
                                        {!! Form::hidden('aplicable_funcionarios', '0', array('id' => 'aplicable_funcionarios')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <div class="checkbox i-checks">
                                            <label> <input name="aplicable_nacionalChk" id="aplicable_nacionalChk" type="checkbox" data-multiple="incluir_matriz_snapChk"><i></i> Usable Nivel Nacional</label>
                                        </div>
                                        {!! Form::hidden('aplicable_nacional', '0', array('id' => 'aplicable_nacional')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <div class="checkbox i-checks">
                                            <label> <input name="aplicable_zonalChk" id="aplicable_zonalChk" type="checkbox" data-multiple="incluir_matriz_snapChk"><i></i> Usable Nivel Zonal</label>
                                        </div>
                                        {!! Form::hidden('aplicable_zonal', '0', array('id' => 'aplicable_zonal')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <div class="checkbox i-checks">
                                            <label> <input name="aplicable_distritoChk" id="aplicable_distritoChk" type="checkbox" data-multiple="incluir_matriz_snapChk"><i></i> Usable Nivel Distrital</label>
                                        </div>
                                        {!! Form::hidden('aplicable_distrito', '0', array('id' => 'aplicable_distrito')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <div class="checkbox i-checks">
                                            <label> <input name="valida_traslados_tramite_distritosChk" id="valida_traslados_tramite_distritosChk" type="checkbox" data-multiple="incluir_matriz_snapChk"><i></i> Cargo Puede Validar Traslados de Trámites</label>
                                        </div>
                                        {!! Form::hidden('valida_traslados_tramite_distritos', '0', array('id' => 'valida_traslados_tramite_distritos')) !!}
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



            $('#aplicable_personasChk').change(function() {
                if($(this).is(":checked")) { $('#aplicable_personas').val('1'); }else{ $('#aplicable_personas').val('0'); }
            });
            $('#aplicable_funcionariosChk').change(function() {
                if($(this).is(":checked")) { $('#aplicable_funcionarios').val('1'); }else{ $('#aplicable_funcionarios').val('0'); }
            });
            $('#aplicable_nacionalChk').change(function() {
                if($(this).is(":checked")) { $('#aplicable_nacional').val('1'); }else{ $('#aplicable_nacional').val('0'); }
            });
            $('#aplicable_zonalChk').change(function() {
                if($(this).is(":checked")) { $('#aplicable_zonal').val('1'); }else{ $('#aplicable_zonal').val('0'); }
            });
            $('#aplicable_distritoChk').change(function() {
                if($(this).is(":checked")) { $('#aplicable_distrito').val('1'); }else{ $('#aplicable_distrito').val('0'); }
            });
            $('#valida_traslados_tramite_distritosChk').change(function() {
                if($(this).is(":checked")) { $('#valida_traslados_tramite_distritos').val('1'); }else{ $('#valida_traslados_tramite_distritos').val('0'); }
            });
        });


    </script>


@stop