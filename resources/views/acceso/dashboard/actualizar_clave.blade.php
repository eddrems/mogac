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
        <p style="font-size: medium;">Usuario / Actualización de Clave de Acceso</p>
    </header>

    <section class="scrollable wrapper">
        <div class="row">
            <div class="col-lg-12">
                @if (Session::has('message'))
                <div class="alert alert-warning alert-block" style="font-size: 15pt"> <button type="button" class="close" data-dismiss="alert">
                    <p>{{ Session::get('message') }}</p>
                </div>
                @else
                <section class="panel panel-default">
                    <header class="panel-heading font-bold"> Cambio de Clave </header>
                    <div class="panel-body">
                        <div class="bs-example form-horizontal">
                            @if (Session::has('message_error'))
                            <div class="alert alert-danger alert-block"> <button type="button" class="close" data-dismiss="alert">
                                    <i class="fa fa-times"></i></button>
                                <p>{{ Session::get('message_error') }}</p>
                            </div>
                            @endif

                            {!! Form::open(array('url' => 'perfil/grabar_actualizar_clave_acceso', 'id' => 'frmAdd')) !!}

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Clave Actual:</label>
                                <div class="col-lg-10">
                                    <input type="password" name="old_password" id="old_password" class="form-control" data-required="true" data-rangelength="[0,20]">
                                </div>
                            </div>
                            <div class="line line-dashed b-b line-lg pull-in"></div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Nueva Clave:</label>
                                <div class="col-lg-10">
                                    <input type="password" name="nueva_clave" id="nueva_clave" class="form-control" data-required="true" data-minlength="6" data-rangelength="[0,20]">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Confirmar Nueva Clave:</label>
                                <div class="col-lg-10">
                                    <input type="password" name="nueva_clave_confirmacion" id="nueva_clave_confirmacion" class="form-control" data-required="true" data-minlength="6" data-rangelength="[0,20]" data-equalto = "#nueva_clave">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fa fa-save pull-right"></i> Cambiar Clave</button>

                            {!! Form::close() !!}

                        </div>
                    </div>
                </section>
                @endif


            </div>
        </div>

    </section>


</section>

@stop

@section('js_code')

<script type="text/javascript">

    var isLoading = false;

    $(document).ready(function () {

        $('#frmAdd').parsley();

    });


</script>


@stop