@extends('layouts.plantillageneraltd')



@section('Dependencias_CSS')

<style type="text/css">

    .dshb_icoNav {
        margin: 0;
        text-align: left;
        margin-bottom:0px;
    }

    .dshb_icoNav li a {
        position: relative;
        display: block;
        padding: 42px 8px 8px;
        width: 140px;
        height: 30px;
        font-size: 10px;
        color: #222;
        background-repeat: no-repeat;
        background-position: center 10px;
        line-height: 100%;
    }

    #maincontainer {
        background-image: url(../img/main_bg.gif);
        background-repeat: no-repeat;
        min-height: 100%;
    }

    .main_content {
        margin-left: 0px;
    }

    .dashicon {
        width: 100px; float: left; height: 120px; background: #5FB1D5; margin-right: 10px; margin-bottom: 10px; position: relative;
        background: #5FB1D5;
        padding-bottom:5px;
        color: white;
    }
    .dashicon.hovered {
        background: #177bbb; /*D0D0D0*/
        border-color:#349AC6;
        /*-moz-box-shadow: 0 0 6px #ccc;
        -webkit-box-shadow: 0 0 6px #ccc;
        box-shadow: 0 0 6px #ccc;*/
        color: white;
        cursor: pointer;

    }

    .dashicon .dashiconname { font-weight: bold; width: 100%; position: absolute; bottom: 20px; text-align: center; font-size: 12px; line-height: 12px; text-align: center; padding: 15px; padding-bottom: 0px; }
    .dashicon .dashiconimage { width: 100%; text-align: center; margin-top: 10px; }
</style>




@stop






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
        <p style="font-size: medium;">
            Bienvenido
            <strong>
                @if (Session::has('nom_fun'))
                {{ Session::get('nom_fun') }}
                @endif
            </strong>
        </p>
    </header>

    <section class="scrollable wrapper">

        <div class="row-fluid">
            <div class="span12">

                @foreach ($modulos as $modulo)

                <a id="est_historico_matriculas" href="{{ URL::to($modulo->controlador .'/'. $modulo->accion) }}">
                    <div class="dashicon">
                        <div class="dashiconimage">
                            <div class="pd"><i class="{{ $modulo->icon }} fa-3x"></i></div>
                        </div>
                        <div class="dashiconname">
                            <div class="pd">{{ $modulo->texto }}</div>
                        </div>
                    </div>
                </a>

                @endforeach



            </div>
        </div>


    </section>
</section>





@stop


@section('js_code')


<script type="text/javascript">
    $(function () {
        $(".dashicon").hover(function () {
            $(this).addClass("hovered");
        }, function () {
            $(this).removeClass("hovered");
        });
    });

</script>



<script type="text/javascript">

    var isLoading = false;

    $(document).ready(function () {


        $('#table_registros').dataTable( {
            "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            "sPaginationType": "full_numbers",
            "oLanguage": {
                "sProcessing":   "Procesando...",
                "sLengthMenu":   "Mostrar _MENU_ registros",
                "sZeroRecords":  "No se encontraron resultados",
                "sInfo":         "Mostrando desde _START_ hasta _END_ de _TOTAL_ registros",
                "sInfoEmpty":    "Mostrando desde 0 hasta 0 de 0 registros",
                "sInfoFiltered": "(filtrado de _MAX_ registros en total)",
                "sInfoPostFix":  "",
                "sSearch":       "Buscar:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sPrevious": "Anterior",
                    "sNext":     "Siguiente",
                    "sLast":     "Último"
                    }
                }
        } );


    });


</script>


@stop

@section('Dependencias_JS')
    <script src="{{ URL::asset('assets/todo/js/datatables/jquery.dataTables.min.js'); }}" type="text/javascript"></script>
@stop

  
