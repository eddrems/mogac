<!DOCTYPE html>
<html lang="es">
<head>
    <title>Ministerio de Educación | Módulo de Gestión de Atención Ciudadana</title>
    <meta charset="UTF-8" />
    <meta name="description" content="El Módulo de Gestión de Atención Ciudadana es una aplicación web que brinda a las plataformas de Atención Ciudadana la facilidad de mantener el control local en tiempo real sobre todos los requerimientos que ingresan por parte de los ciudadanos, a través de varios módulos que permiten la generación de turnos, registro de requerimientos (trámites), reportes, respuestas y archivo de los trámites dentro en cada una de las Direcciones Distritales del Ministerio de Educación." />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta property="og:title" content="Módulo de Gestión de Atención Ciudadana - Ministerio de Educación del Ecuador" />
    <meta property="og:image" content="http://atencionciudadana.educacion.gob.ec/media/sys/logo_mec.png" />
    <meta property="og:url" content="http://atencionciudadana.educacion.gob.ec/" />
    <meta property="og:description" content="El Módulo de Gestión de Atención Ciudadana es una aplicación web que brinda a las plataformas de Atención Ciudadana la facilidad de mantener el control local en tiempo real sobre todos los requerimientos que ingresan por parte de los ciudadanos, a través de varios módulos que permiten la generación de turnos, registro de requerimientos (trámites), reportes, respuestas y archivo de los trámites dentro en cada una de las Direcciones Distritales del Ministerio de Educación." />



    <link rel="stylesheet" href="{{ asset('frontend/assets/todo/css/bootstrap.css') }}" type="text/css" cache="false" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/todo/css/font.css') }}" type="text/css" cache="false" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/todo/css/app.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/toastr/toastr.min.css') }}" type="text/css" />

    <!--[if lt IE 9]>
    <script src="{{ asset('frontend/assets/todo/js/ie/respond.min.js') }}" cache="false"></script>
    <script src="{{ asset('frontend/assets/todo/js/ie/html5.js') }}" cache="false"></script>
    <script src="{{ asset('frontend/assets/todo/js/ie/fix.js') }}" cache="false"></script>
    <![endif]-->

    @section('CSS')

    @show

</head>
<body style="padding:20px; padding-top:15px;">

<section class="panel" style="padding:20px;">
    <div class="row b-b">
        <div class="col-md-6">
            <img class="hidden-phone" src="{{ asset('frontend/img_ui/logo_mec.png') }}" /><br>&nbsp;
        </div>
        <div class="col-md-6" style="text-align:right;">
            <img class="hidden-xs" src="{{ asset('frontend/img_ui/ecuador.png') }}" style="height: 90px;" />
        </div>
    </div>
    <div style="width:100%; text-align:center;">
        <h3>Módulo de Gestión de Atención Ciudadana</h3>
    </div>
    <div class="row m-n">
        @yield('content')
    </div>
</section>
<!-- footer -->
<footer id="footer">
    <div class="text-center padder clearfix">
        <p>
            <small>
                Ministerio de Educación  |  Av. Amazonas N34-451 y Av. Atahualpa  |  Código Pstal 170515 / Quito - Ecuador  |  Teléfono: 593-2-396-1300 / 1400 / 1500  |  1800 - EDUCACION
            </small>
        </p>
    </div>
</footer>
<!-- / footer -->


<script src="{{ asset('frontend/assets/scripts/jquery.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/assets/todo/js/bootstrap.js') }}"></script>


<script src="{{ asset('frontend/assets/todo/js/parsley/messages.es.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/assets/todo/js/parsley/parsley.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/assets/todo/js/parsley/parsley.extend.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/assets/toastr/toastr.min.js') }}" type="text/javascript"></script>


{!! Toastr::render() !!}

@section('JS')

@show

@section('js_code')

@show





</body>
</html>