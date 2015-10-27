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
            <a href="{{ url('catalogos/distritos/crear') }}" class="btn btn-primary btn-sm  pull-right" style="margin-right:5px; " >Nuevo Registro</a>
            <p style="font-size: medium;"><i class="fa fa-database"></i> Catálogos / <strong>Distritos</strong></p>
        </header>

        <section class="scrollable wrapper">

            <div class="tab-pane" id="datatable">
                <section class="panel panel-primary">
                    <header class="panel-heading">
                        Registros
                        <i class="fa fa-info-sign text-muted" data-toggle="tooltip" data-placement="bottom" data-title="ajax to load the data."></i>
                    </header>
                    <div class="table-responsive">

                        {!!
                        Datatable::table()
                        ->addColumn('Cód.', 'Zona', 'Denominación Inst.', '')
                        ->setUrl(URL::to('catalogos/distritos/buscar_registros_dt'))
                        ->noScript()
                        ->render('catalogos.gen_distritos.dt_template')
                        !!}

                    </div>
                </section>
            </div>

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


