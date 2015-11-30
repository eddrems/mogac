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
            <a href="{{ URL::to('catalogos/procesos_ac/requisitos/listar') . '/' . Crypt::encrypt($proceso->id_proceso) }}" class="btn btn-default btn-sm  pull-right" style="margin-right:5px; "><i class="icon-share-alt icon-black"></i> Cancelar</a>
            <p style="font-size: medium;" class="text-muted clear text-ellipsis"><i class="fa fa-database"></i> Catálogos / Procesos de A.C. / <strong>Requisitos</strong> / Eliminar </p>
        </header>

        <section class="scrollable wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="m-b-md m-t-xs text-black"><i class="fa  fa-arrow-circle-o-right"></i> {!! $proceso->denominacion !!}</h3>

                    <section class="panel panel-danger">
                        <header class="panel-heading font-bold"> Confirmar</header>
                        <div class="panel-body">
                            <div class="bs-example form-horizontal">

                                {!! Form::open(array('url' => 'catalogos/procesos_ac/requisitos/grabar_eliminar', 'id' => 'frmMain')) !!}
                                {!! Form::hidden('id', Crypt::encrypt($registro->id_requisitos)) !!}
                                {!! Form::hidden('id_proceso', Crypt::encrypt($registro->id_proceso)) !!}

                                <div class="form-group">
                                    <label class="col-lg-12 ">
                                        <div class="col-lg-12">
                                            <h5>Desea eliminar de forma permanente el registro:</h5>
                                            <h3 style="margin-top: 0px;"><strong>{!! $registro->nombre !!}</strong></h3>
                                            <br>
                                            <button type="sumbit" class="btn btn-danger btn-lg btn-block"><i class="fa fa-trash-o pull-right"></i> Confirmar Eliminación</button>
                                        </div>
                                    </label>
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


        });

    </script>


@stop