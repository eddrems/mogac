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

    <section class="vbox" id="modulo">
        <header class="header b-b bg-white hidden-print">
            <a href="{{ url('catalogos/procesos_ac/requisitos/crear') . '/' .Crypt::encrypt($proceso->id_proceso)  }}" class="btn btn-primary btn-sm  pull-right" style="margin-right:5px; " >Nuevo Registro</a>
            <a href="{{ url('catalogos/procesos_ac') }}" class="btn btn-default btn-sm  pull-right" style="margin-right:5px; " >Regresar</a>
            <p style="font-size: medium;"><i class="fa fa-database"></i> Catálogos / Procesos de A.C. / <strong>Requisitos</strong></p>
        </header>

        <section class="scrollable wrapper">

            <h3 class="m-b-md m-t-xs text-black"><i class="fa  fa-arrow-circle-o-right"></i> {!! $proceso->denominacion !!}</h3>
            <section class="panel panel-primary">
                <header class="panel-heading">
                    Registros
                    <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
                </header>
                <div class="table-responsive">

                    {!!
                    Datatable::table()
                    ->addColumn('Denominación', '')
                    ->setUrl(URL::to('catalogos/procesos_ac/requisitos/buscar_registros_dt') . '/' . Crypt::encrypt($proceso->id_proceso))
                    ->noScript()
                    ->render('catalogos.ac_procesos_requisitos.dt_template')
                    !!}

                </div>
            </section>

        </section>

    </section>


@stop



@section('Dependencias_CSS')


@endsection



@section('Dependencias_JS')

    <script src="{{ asset('frontend/assets/todo/js/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>



@endsection



@section('js_code')




    <script type="text/javascript">


        $(document).ready(function () {

            $("#nav").addClass("nav-xs");

        });

    </script>


@stop


