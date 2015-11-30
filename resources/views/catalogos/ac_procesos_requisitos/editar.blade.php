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
            <a href="{{ URL::to('catalogos/procesos_ac/requisitos/listar') . '/' . Crypt::encrypt($proceso->id_proceso) }}" class="btn btn-default btn-sm  pull-right" style="margin-right:5px; "><i class="icon-share-alt icon-black"></i> Regresar</a>
            <p style="font-size: medium;"><i class="fa fa-database"></i> Catálogos / Procesos de A.C. / <strong>Requisitos</strong> / Editar </p>
        </header>

        <section class="scrollable wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="m-b-md m-t-xs text-black"><i class="fa  fa-arrow-circle-o-right"></i> {!! $proceso->denominacion !!}</h3>
                    <section class="panel panel-warning">
                        <header class="panel-heading font-bold"> Editar: {!! strtoupper($reqistroe->nombre) !!} </header>
                        <div class="panel-body">
                            <div class="bs-example form-horizontal">

                                {!! Form::open(array('url' => 'catalogos/procesos_ac/requisitos/grabar_actualizar', 'id' => 'frmMain')) !!}
                                {!! Form::hidden('id_proceso', Crypt::encrypt($proceso->id_proceso)) !!}
                                {!! Form::hidden('id', Crypt::encrypt($reqistroe->id_requisitos)) !!}

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Denominaci&oacute;n:</label>
                                    <div class="col-lg-10">
                                        {!! Form::text('nombre', Input::old('nombre') ? Input::old('nombre') : $reqistroe->nombre, array('class' => 'form-control', 'data-required' => 'true')) !!}
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-lg-2 control-label">observaciones</label>
                                    <div class="col-lg-10">
                                        {!! Form::textarea('observaciones', Input::old('observaciones') ? Input::old('observaciones') : $reqistroe->observaciones, array('class' => 'form-control')) !!}
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