<!DOCTYPE html>
<html lang="es" class="app">
<head>  
    <meta charset="utf-8" />
    <title>Ministerio de Educación | Módulo de Gestión de Atención Ciudadana |
        @if (Session::has('ses_ie_denominacion'))
        {{ Session::get('ses_ie_denominacion') }}
        @endif
    </title>
    <meta name="description" content="El Módulo de Gestión de Atención Ciudadana es una aplicación web que brinda a las plataformas de Atención Ciudadana la facilidad de mantener el control local en tiempo real sobre todos los requerimientos que ingresan por parte de los ciudadanos, a través de varios módulos que permiten la generación de turnos, registro de requerimientos (trámites), reportes, respuestas y archivo de los trámites dentro en cada una de las Direcciones Distritales del Ministerio de Educación." />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta property="og:title" content="Módulo de Gestión de Atención Ciudadana - Ministerio de Educación del Ecuador" />
    <meta property="og:image" content="http://atencionciudadana.educacion.gob.ec/media/sys/logo_mec.png" />
    <meta property="og:url" content="http://atencionciudadana.educacion.gob.ec/" />
    <meta property="og:description" content="El Módulo de Gestión de Atención Ciudadana es una aplicación web que brinda a las plataformas de Atención Ciudadana la facilidad de mantener el control local en tiempo real sobre todos los requerimientos que ingresan por parte de los ciudadanos, a través de varios módulos que permiten la generación de turnos, registro de requerimientos (trámites), reportes, respuestas y archivo de los trámites dentro en cada una de las Direcciones Distritales del Ministerio de Educación." />

    <link rel="stylesheet" href="{{ asset('frontend/assets/todo/css/bootstrap.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/todo/css/animate.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/todo/css/font-awesome.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/todo/css/icon.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/todo/css/font.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/todo/css/app.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/todo/js/datatables/datatables.css') }}" type="text/css" />

    <link rel="stylesheet" href="{{ asset('frontend/assets/toastr/toastr.min.css') }}" type="text/css" />


    <style type="text/css">
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('{{URL::to("/")}}/frontend/img_ui/page-loader.gif') 50% 50% no-repeat rgb(249,249,249);
        }
    </style>

    @section('Dependencias_CSS')

    @show

    <link rel="stylesheet" href="{{ asset('frontend/assets/todo/js/chosen/chosen.css') }}" type="text/css" />
    <script src="{{ asset('frontend/assets/scripts/jquery.js') }}" type="text/javascript"></script>

    <!--[if lt IE 9]>
    <script src="{{ asset('frontend/assets/todo/js/ie/html5shiv.js') }}"></script>
    <script src="{{ asset('frontend/assets/todo/js/ie/respond.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/todo/js/ie/excanvas.js') }}"></script>
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
    @section('page_loader')

    @show
    <section class="vbox">
        <header class="bg-primary header header-md navbar navbar-fixed-top-xs box-shadow">
            <div class="navbar-header aside-md dk">
                <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
                    <i class="fa fa-bars"></i>
                </a>
                <a href="{{ URL::to('inicio') }}" class="navbar-brand">
                    <img src="{{ asset('frontend/img_ui/logo_mec_white.png') }}" class="m-r-sm" alt="Ministerio de Educación" style="max-height: 50px;">
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
                            @if (Session::has('ses_ie_denominacion'))
                                {{ Session::get('ses_ie_denominacion') }}
                            @endif
                        </span>
                    </span>
                    </div>
                </div>
            </div>
            <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">
                @section('Mensajeria')

                @show

                <li class="dropdown menu_usuario">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="thumb-sm avatar pull-left">
                        @if(Auth::user()->path_imagen)
                        <img src="{{ asset('frontend/img_ui/imgperfiles/' . Auth::user()->path_imagen) }}" alt="...">
                        @else
                        <img src="{{ asset('frontend/img_ui/avatar1.png') }}" alt="...">
                        @endif
                    </span>
                        @if (Session::has('ses_usuario'))
                        {{ Session::get('ses_usuario') }}
                        @endif
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight">
                        <li><a href="{{ URL::to('perfil/actualizar_clave_acceso') }}" >Cambiar Clave</a></li>
                        <li><a href="{{ URL::to('perfil/cambio_imagen') }}" >Actualizar Fotografía</a></li>
                        <li><a href="{{ URL::to('perfil/ver_logs') }}" >Ver Logs</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ URL::to('cerrar_sesion') }}" >Cerrar Sesion</a></li>
                    </ul>
                </li>
            </ul>
        </header>
        <section>
            <section class="hbox stretch">
                <!-- .aside -->
                <aside class="bg-dark lt b-r b-light aside-md hidden-print hidden-xs" id="nav">
                    <section class="vbox">
                        <section class="w-f scrollable">
                            <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">
                                <nav class="nav-primary hidden-xs">
                                    <div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">&nbsp;</div>
                                    <ul class="nav nav-main" data-ride="collapse">
                                        @if (Session::has('ses_menu'))
                                        {!! Session::get('ses_menu') !!}
                                        @endif
                                    </ul>
                                </nav>
                                <!-- / nav -->
                            </div>
                        </section>

                        <footer class="footer hidden-xs no-padder text-center-nav-xs">
                            <a href="#nav" data-toggle="class:nav-xs" class="btn btn-icon icon-muted btn-inactive m-l-xs m-r-xs">
                                <i class="i i-circleleft text"></i>
                                <i class="i i-circleright text-active"></i>
                            </a>
                        </footer>
                    </section>
                </aside>
                <!-- /.aside -->
                <section id="content">

                    @yield('content')

                </section>
            </section>
        </section>





    </section>





    @section('Modals')

    @show
    

    <script src="{{ asset('frontend/assets/todo/js/bootstrap.js') }}"></script>
    <script src="{{ asset('frontend/assets/todo/js/app.js') }}"></script>
    <script src="{{ asset('frontend/assets/todo/js/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <script src="{{ asset('frontend/assets/toastr/toastr.min.js') }}" type="text/javascript"></script>
    
    <script src="{{ asset('frontend/assets/todo/js/chosen/chosen.jquery.min.js') }}"></script>    
    <script src="{{ asset('frontend/assets/todo/js/app.plugin.js') }}"></script>

    <script src="{{ asset('frontend/assets/parsley/parsley.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('frontend/assets/parsley/es.js') }}" type="text/javascript"></script>
    <script src="{{ asset('frontend/assets/blockui/jquery.blockUI.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        window.ParsleyValidator
            .addValidator('validarcedula', function (value, requirement) {

                var total_caracteres = value.length;
                if(total_caracteres == 10)
                {

                    var nro_region = value.substring(0, 2);
                    var val_nro_region = parseInt(nro_region);

                    if(val_nro_region>=1 && val_nro_region<=24)
                    {

                        var ult_digito = value.substring(9,10);

                        var valor2=value.substring(1, 2);
                        var valor4=value.substring(3, 4);
                        var valor6=value.substring(5, 6);
                        var valor8=value.substring(7, 8);

                        var suma_pares=(parseInt(valor2) + parseInt(valor4) + parseInt(valor6)+ parseInt(valor8));

                        var valor1=value.substring(0, 1);
                        valor1=(valor1 * 2);
                        if(valor1>9){ valor1=(valor1 - 9); }
                        var valor3=value.substring(2, 3);
                        valor3=(valor3 * 2);
                        if(valor3>9){ valor3=(valor3 - 9); }
                        var valor5=value.substring(4, 5);
                        valor5=(valor5 * 2);
                        if(valor5>9){ valor5=(valor5 - 9); }
                        var valor7=value.substring(6, 7);
                        valor7=(valor7 * 2);
                        if(valor7>9){ valor7=(valor7 - 9); }
                        var valor9=value.substring(8, 9);
                        valor9=(valor9 * 2);
                        if(valor9>9){ valor9=(valor9 - 9); }


                        var suma_impares=(parseInt(valor1) + parseInt(valor3) + parseInt(valor5) + parseInt(valor7) + parseInt(valor9));

                        var suma=(suma_pares + suma_impares);

                        var dis=suma.toString().substring(0,1);

                        var dis_int=((parseInt(dis) + 1)* 10);

                        var digito=(dis_int - suma);

                        if(digito==10){ digito=0; }

                        if(digito.toString() == ult_digito)
                        { return true; }
                        else
                        { return false; }

                    }
                    else
                    {
                        return false;
                    }
                }
                else
                {
                    return false;
                }
            }, 32)
            .addMessage('es', 'validarcedula', 'El número de cédula no es correcto');
    </script>


    {!! Toastr::render() !!}


    @section('Dependencias_JS')
    
    @show



    @section('js_code')
    
    @show   
        
    
</body>
</html>