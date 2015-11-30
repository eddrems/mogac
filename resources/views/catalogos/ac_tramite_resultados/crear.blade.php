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
            <a href="{{ URL::to('catalogos/tramites_resultado') }}" class="btn btn-default btn-sm  pull-right" style="margin-right:5px; "><i class="icon-share-alt icon-black"></i> Cancelar</a>
            <p style="font-size: medium;"><i class="fa fa-database"></i> Catálogos / <strong>Resutado Trámites</strong> / Crear</p>
        </header>

        <section class="scrollable wrapper">
            <div class="row">
                <div class="col-lg-12">

                    <section class="panel panel-warning">
                        <header class="panel-heading font-bold"> Crear Registro </header>
                        <div class="panel-body">
                            <div class="bs-example form-horizontal">

                                {!! Form::open(array('url' => 'catalogos/tramites_resultado/grabar_nuevo', 'id' => 'frmMain')) !!}



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
                                            <label> <input name="requiere_observacionesChk" id="requiere_observacionesChk" type="checkbox" data-multiple="incluir_matriz_snapChk"><i></i> Requiere Ingreso de Observaciones</label>
                                        </div>
                                        {!! Form::hidden('requiere_observaciones', '0', array('id' => 'requiere_observaciones')) !!}
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

            $('#requiere_observacionesChk').change(function() {
                if($(this).is(":checked")) { $('#requiere_observaciones').val('1'); }else{ $('#requiere_observaciones').val('0'); }
            });

        });


    </script>


@stop