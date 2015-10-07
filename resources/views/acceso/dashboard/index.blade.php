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
        <a href="javascript:void(0)" onclick="intro.start();" class="btn btn-default btn-sm  pull-right hidden-xs" ><i class="fa fa-question-circle"></i> Ayuda</a>
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
        <div class="wrapper text-center active">
            <span class="h2">

            </span>
        </div>


    </section>
</section>





@stop


@section('js_code')

<script type="text/javascript">

    var isLoading = false;

    var intro = introJs();

    intro.setOptions({
        steps: [
            {
                element: '.nav-main',
                intro: '<p class="h4 text-uc"><strong>1: Menú de Aplicación</strong></p><p>Desde aquí podrá acceder a los distintas opciones del Aplicativo.</p>',
                position: 'right'
            },
            {
                element: '.menu_usuario',
                intro: '<p class="h4 text-uc"><strong>2: Menú de Usuario</strong></p><p>Desde aquí podrá actualizar su clave de acceso, ver logs de uso y cerrar sesión.</p>',
                position: 'left'
            },
            {
                element: '.navbar-brand',
                intro: '<p class="h4 text-uc"><strong>3: Inicio</strong></p><p>Si desea volver a la página de inicio podrá acerlo mediante un clic en el logo.</p>',
                position: 'bottom'
            }
        ],
        showBullets: true,
    });





</script>


@stop



@section('Dependencias_CSS')

    <link rel="stylesheet" href="{{ asset('frontend/assets/todo/js/intro/introjs.css') }}" type="text/css" />

@stop



@section('Dependencias_JS')

    <script src="{{ asset('frontend/assets/todo/js/intro/intro.min.js') }}" type="text/javascript"></script>

@stop

  
