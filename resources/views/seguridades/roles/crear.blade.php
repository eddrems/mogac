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
            <a href="{{ URL::to('seguridades/roles') }}" class="btn btn-default btn-sm  pull-right" style="margin-right:5px; "><i class="icon-share-alt icon-black"></i> Cancelar</a>
            <p style="font-size: medium;"><i class="fa fa-unlock"></i> Seguridades / <strong> Roles</strong> / Crear</p>
        </header>

        <section class="scrollable wrapper">
            <div class="row">
                <div class="col-lg-12">

                    <section class="panel panel-warning">
                        <header class="panel-heading font-bold"> Crear Registro </header>
                        <div class="panel-body">
                            <div class="bs-example form-horizontal">

                                {!! Form::open(array('url' => 'seguridades/roles/grabar_nuevo', 'id' => 'frmMain')) !!}
                                {!! Form::hidden('predefinido_modulo_id', 22) !!}


                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Denominaci&oacute;n:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('denominacion', Input::old('denominacion') ? Input::old('denominacion') : '', array('class' => 'form-control', 'data-required' => 'true', 'autocomplete' => 'off')) !!}
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Denominaci&oacute;n Visual:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('denominacion_visual', Input::old('denominacion_visual') ? Input::old('denominacion_visual') : '', array('class' => 'form-control', 'data-required' => 'true', 'autocomplete' => 'off')) !!}
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <div class="checkbox i-checks">
                                            <label> <input name="esta_vigenteChk" id="esta_vigenteChk" type="checkbox" data-multiple="incluir_matriz_snapChk"><i></i> Vigente</label>
                                        </div>
                                        {!! Form::hidden('esta_vigente', '0', array('id' => 'esta_vigente')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <div class="checkbox i-checks">
                                            <label> <input name="nivel_nacionalChk" id="nivel_nacionalChk" type="checkbox" data-multiple="incluir_matriz_snapChk"><i></i> Nacional</label>
                                        </div>
                                        {!! Form::hidden('nivel_nacional', '0', array('id' => 'nivel_nacional')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <div class="checkbox i-checks">
                                            <label> <input name="nivel_zonalChk" id="nivel_zonalChk" type="checkbox" data-multiple="incluir_matriz_snapChk"><i></i> Zonal</label>
                                        </div>
                                        {!! Form::hidden('nivel_zonal', '0', array('id' => 'nivel_zonal')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label"></label>
                                    <div class="col-lg-10">
                                        <div class="checkbox i-checks">
                                            <label> <input name="nivel_distritalChk" id="nivel_distritalChk" type="checkbox" data-multiple="incluir_matriz_snapChk"><i></i> Distrital</label>
                                        </div>
                                        {!! Form::hidden('nivel_distrital', '0', array('id' => 'nivel_distrital')) !!}
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

            $('#esta_vigenteChk').change(function() {
                if($(this).is(":checked")) { $('#esta_vigente').val('1'); }else{ $('#esta_vigente').val('0'); }
            });
            $('#nivel_nacionalChk').change(function() {
                if($(this).is(":checked")) { $('#nivel_nacional').val('1'); }else{ $('#nivel_nacional').val('0'); }
            });
            $('#nivel_zonalChk').change(function() {
                if($(this).is(":checked")) { $('#nivel_zonal').val('1'); }else{ $('#nivel_zonal').val('0'); }
            });
            $('#nivel_distritalChk').change(function() {
                if($(this).is(":checked")) { $('#nivel_distrital').val('1'); }else{ $('#nivel_distrital').val('0'); }
            });

        });


    </script>


@stop