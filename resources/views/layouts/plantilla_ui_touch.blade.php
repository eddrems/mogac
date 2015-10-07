<!DOCTYPE html>
<html lang="es" class="app">
<head>
    <meta charset="utf-8" />
    <title>Ministerio de Educación | Módulo de Gestión de Atención Ciudadana |
        @if (Session::has('establecimiento'))
        {{ Session::get('establecimiento') }}
        @endif
    </title>
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="{{ URL::asset('assets/todo/css/bootstrap.css'); }}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/todo/css/animate.css'); }}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/todo/css/font-awesome.min.css'); }}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/todo/css/icon.css'); }}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/todo/css/font.css'); }}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/todo/css/app.css'); }}" type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/todo/js/datatables/datatables.css'); }}" type="text/css" />

    <link rel="stylesheet" href="{{ URL::asset('assets/toastr/toastr.min.css'); }}" type="text/css" />

    @section('Dependencias_CSS')

    @show

    <link rel="stylesheet" href="{{ URL::asset('assets/todo/js/chosen/chosen.css'); }}" type="text/css" />
    <script src="{{ URL::asset('assets/scripts/jquery.js'); }}" type="text/javascript"></script>

    <!--[if lt IE 9]>
    <script src="{{ URL::asset('assets/todo/js/ie/html5shiv.js'); }}"></script>
    <script src="{{ URL::asset('assets/todo/js/ie/respond.min.js'); }}"></script>
    <script src="{{ URL::asset('assets/todo/js/ie/excanvas.js'); }}"></script>
    <![endif]-->


    <style>
        body.modal-open{
            margin-right:0px!important;
        }
        .modal-open .navbar-fixed-top{
            margin-right:0px!important;
        }
    </style>
</head>
<body class="" >
<section class="vbox">
    <header class="bg-primary header header-md navbar navbar-fixed-top-xs box-shadow">
        <div class="navbar-header aside-md dk">
            <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
                <i class="fa fa-bars"></i>
            </a>
            <a href="{{ URL::to('inicio'); }}" class="navbar-brand">
                <img src="{{ URL::asset('media/sys/logo_mec_white.png'); }}" class="m-r-sm" alt="Ministerio de Educación" style="max-height: 50px;">
            </a>
            <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
                <i class="fa fa-cog"></i>
            </a>
        </div>
        <div class="navbar-form navbar-left input-s-lg m-t m-l-n-xs hidden-xs">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-btn">
                        <span class="h4 font-thin"><i class="fa fa-home"></i>
                            @if (Session::has('establecimiento'))
                                {{ Session::get('establecimiento') }}
                            @endif
                        </span>
                    </span>
                </div>
            </div>
        </div>

    </header>
    <section>
        <section class="hbox stretch">
            <!-- .aside -->

            <!-- /.aside -->
            <section id="content">
                @yield('content')

            </section>
        </section>
    </section>





</section>





@section('Modals')

@show


<script src="{{ URL::asset('assets/todo/js/bootstrap.js'); }}"></script>
<script src="{{ URL::asset('assets/todo/js/app.js'); }}"></script>
<script src="{{ URL::asset('assets/todo/js/slimscroll/jquery.slimscroll.min.js'); }}"></script>

<script src="{{ URL::asset('assets/toastr/toastr.min.js'); }}" type="text/javascript"></script>

<script src="{{ URL::asset('assets/todo/js/chosen/chosen.jquery.min.js'); }}"></script>
<script src="{{ URL::asset('assets/todo/js/app.plugin.js'); }}"></script>
<script src="{{ URL::asset('assets/parsley/parsley.min.js'); }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/parsley/es.js'); }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/blockui/jquery.blockUI.js'); }}" type="text/javascript"></script>

<script type="text/javascript">



</script>
{{ Toastr::render() }}


@section('Dependencias_JS')

@show



@section('js_code')

@show



</body>
</html>