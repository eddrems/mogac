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
            <a href="{{ URL::to('catalogos/cargos_funcionarios') }}" class="btn btn-default btn-sm  pull-right" style="margin-right:5px; "><i class="icon-share-alt icon-black"></i> Regresar</a>
            <p style="font-size: medium;"><i class="fa fa-database"></i> Catálogos / <strong> RRHH - Cargos</strong> / Editar </p>
        </header>

        <section class="scrollable wrapper">
            <div class="row">
                <div class="col-lg-12">

                    <section class="panel panel-warning">
                        <header class="panel-heading font-bold"> Editar: {!! strtoupper($registro->denominacion) !!} </header>
                        <div class="panel-body">
                            <div class="bs-example form-horizontal">

                                {!! Form::open(array('url' => 'catalogos/cargos_funcionarios/grabar_actualizar', 'id' => 'frmMain')) !!}

                                {!! Form::hidden('id', Crypt::encrypt($registro->id_cargo)) !!}




                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Denominaci&oacute;n:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('denominacion', Input::old('denominacion') ? Input::old('denominacion') : $registro->denominacion, array('class' => 'form-control', 'data-required' => 'true', 'autocomplete' => 'off')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <div class="checkbox i-checks">
                                            @if ($registro->aplicable_personas == 0)
                                                <label> <input name="aplicable_personasChk" id="aplicable_personasChk" type="checkbox" data-multiple="aplicable_personasChk"><i></i> Usable En Personas</label>
                                            @else
                                                <label> <input name="aplicable_personasChk" id="aplicable_personasChk" type="checkbox" data-multiple="aplicable_personasChk" checked><i></i> Usable En Personas</label>
                                            @endif
                                        </div>
                                        {!! Form::hidden('aplicable_personas', $registro->aplicable_personas, array('id' => 'aplicable_personas')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <div class="checkbox i-checks">
                                            @if ($registro->aplicable_funcionarios == 0)
                                                <label> <input name="aplicable_funcionariosChk" id="aplicable_funcionariosChk" type="checkbox" data-multiple="aplicable_funcionariosChk"><i></i> Usable en Funcionarios</label>
                                            @else
                                                <label> <input name="aplicable_funcionariosChk" id="aplicable_funcionariosChk" type="checkbox" data-multiple="aplicable_funcionariosChk" checked><i></i> Usable en Funcionarios</label>
                                            @endif
                                        </div>
                                        {!! Form::hidden('aplicable_funcionarios', $registro->aplicable_funcionarios, array('id' => 'aplicable_funcionarios')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <div class="checkbox i-checks">
                                            @if ($registro->aplicable_nacional == 0)
                                                <label> <input name="aplicable_nacionalChk" id="aplicable_nacionalChk" type="checkbox" data-multiple="aplicable_nacionalChk"><i></i> Usable Nivel Nacional</label>
                                            @else
                                                <label> <input name="aplicable_nacionalChk" id="aplicable_nacionalChk" type="checkbox" data-multiple="aplicable_nacionalChk" checked><i></i> Usable Nivel Nacional</label>
                                            @endif
                                        </div>
                                        {!! Form::hidden('aplicable_nacional', $registro->aplicable_nacional, array('id' => 'aplicable_nacional')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <div class="checkbox i-checks">
                                            @if ($registro->aplicable_zonal == 0)
                                                <label> <input name="aplicable_zonalChk" id="aplicable_zonalChk" type="checkbox" data-multiple="aplicable_zonalChk"><i></i> Usable Nivel Zonal</label>
                                            @else
                                                <label> <input name="aplicable_zonalChk" id="aplicable_zonalChk" type="checkbox" data-multiple="aplicable_zonalChk" checked><i></i> Usable Nivel Zonal</label>
                                            @endif
                                        </div>
                                        {!! Form::hidden('aplicable_zonal', $registro->aplicable_zonal, array('id' => 'aplicable_zonal')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <div class="checkbox i-checks">
                                            @if ($registro->aplicable_distrito == 0)
                                                <label> <input name="aplicable_distritoChk" id="aplicable_distritoChk" type="checkbox" data-multiple="aplicable_distritoChk"><i></i> Usable Nivel Distrital</label>
                                            @else
                                                <label> <input name="aplicable_distritoChk" id="aplicable_distritoChk" type="checkbox" data-multiple="aplicable_distritoChk" checked><i></i> Usable Nivel Distrital</label>
                                            @endif
                                        </div>
                                        {!! Form::hidden('aplicable_distrito', $registro->aplicable_distrito, array('id' => 'aplicable_distrito')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <div class="checkbox i-checks">
                                            @if ($registro->valida_traslados_tramite_distritos == 0)
                                                <label> <input name="valida_traslados_tramite_distritosChk" id="valida_traslados_tramite_distritosChk" type="checkbox" data-multiple="valida_traslados_tramite_distritosChk"><i></i>  Cargo Puede Validar Traslados de Trámites</label>
                                            @else
                                                <label> <input name="valida_traslados_tramite_distritosChk" id="valida_traslados_tramite_distritosChk" type="checkbox" data-multiple="valida_traslados_tramite_distritosChk" checked><i></i>  Cargo Puede Validar Traslados de Trámites</label>
                                            @endif
                                        </div>
                                        {!! Form::hidden('valida_traslados_tramite_distritos', $registro->valida_traslados_tramite_distritos, array('id' => 'valida_traslados_tramite_distritos')) !!}
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