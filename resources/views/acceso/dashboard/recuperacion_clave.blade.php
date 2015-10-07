<!DOCTYPE html>
<html lang="es">
<head>
    <title>Ministerio de Educación | Módulo de Gestión de Atención Ciudadana</title>
    <meta charset="UTF-8" />
    <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />



    <link rel="stylesheet" href="{{ URL::asset('assets/todo/css/bootstrap.css'); }}" type="text/css" />



    <link rel="stylesheet" href="{{ URL::asset('assets/todo/css/font.css'); }}" type="text/css" cache="false" />
    <link rel="stylesheet" href="{{ URL::asset('assets/todo/css/app.css'); }}" type="text/css" />

    <!--[if lt IE 9]>
    <script src="{{ URL::asset('Assets/todo/js/ie/respond.min.js'); }}" cache="false"></script>
    <script src="{{ URL::asset('Assets/todo/js/ie/html5.js'); }}" cache="false"></script>
    <script src="{{ URL::asset('Assets/todo/js/ie/fix.js'); }}" cache="false"></script>
    <![endif]-->


</head>
<body style="padding:20px; padding-top:15px;">

    <section class="panel" style="padding:20px;">
        <div class="row b-b">
            <div class="col-md-6">
                <img class="hidden-phone" src="{{ URL::asset('media/sys/logo_mec.png') }}" /><br>&nbsp;
            </div>
            <div class="col-md-6" style="text-align:right;">
                <img class="hidden-phone" src="{{ URL::asset('media/sys/ecuador.png') }}" style="height: 90px;" />
            </div>
        </div>
        <div style="width:100%; text-align:center;">
            <h3>Módulo de Gestión de Atención Ciudadana</h3>
        </div>
        <div class="row m-n">
            <div class="col-md-8 col-md-offset-2 m-t-lg" style="margin-top: 20px;">

                @if (Session::has('message_recuperacion'))

                <section class="panel bg-light lt" >
                    <header class="panel-heading bg bg-success text-center">Proceso de Recuperación Iniciado</header>
                    <div  style="padding:15px; text-align: center;">
                        @if (Session::has('message_recuperacion'))
                        <h2 style="margin-top:10px;">{{ Session::get('message_recuperacion') }}</h2>
                            @endif
                            <br>
                            <a href="{{ URL::to('acceso') }}" class="btn btn-success">Regresar</a>
                    </div>
                </section>

                @else

                <section class="panel bg-light lt" >
                    <header class="panel-heading bg bg-info lt text-center">Recuperación de Clave</header>
                    {{ Form::open(array('url' => 'acceso/mkRecuperar', 'id' => 'frmLogin', 'class' => 'panel-body')) }}
                    <div class="alert alert-warning" style="text-align: justify;">
                        <strong>Estimado Usuario!</strong><br>
                        Para recuperar su clave ingrese su número de identificación que puede ser su número de cédula de identidad o pasaporte; y, a contonuación se le enviará a su dirección de correo electrónico registrada los pasos necesarios para resetear su clave.
                    </div>
                    <div class="form-group">
                        <label class="control-label">CI/Identificación:</label>
                        {{ Form::text('identificacion',  Session::get('identificacion') , array('class' => 'form-control', 'data-required' => 'true', 'data-rangelength' => '[0,13]', 'autocomplete' => 'off')) }}

                    </div>
                    <div class="form-group">
                        <label class="control-label">Ingrese el texto de la imagen:</label><br>
                        {{ HTML::image(Captcha::img(), 'Captcha image') }}

                        {{ Form::text('captcha',  '' , array('class' => 'form-control', 'data-required' => 'true', 'autocomplete' => 'off')) }}
                    </div>
                    @if (Session::has('message'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button>
                        <p>{{ Session::get('message') }}</p>
                    </div>
                    @endif
                    <button type="submit" class="btn btn-block btn-info btn-lg">Recuperar Clave de Acceso</button>
                    <p class="text-muted text-center" style="margin-top: 10px; margin-bottom: 0px;"><small><a href="{{ URL::to('acceso/') }}">Regresar</a></small></p>
                    {{ Form::close() }}
                </section>

                @endif
            </div>
        </div>
    </section>
  <!-- footer -->
    <footer id="footer">
        <div class="text-center padder clearfix">
            <p>              
                <small>&copy;Ministerio de Educación, Distritos Chone - Cuenca</small>
            </p>
        </div>
    </footer>
  <!-- / footer -->


<script src="{{ URL::asset('assets/scripts/jquery.js'); }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/todo/js/bootstrap.js'); }}"></script>


<script src="{{ URL::asset('assets/todo/js/parsley/messages.es.js'); }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/todo/js/parsley/parsley.min.js'); }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/todo/js/parsley/parsley.extend.js'); }}" type="text/javascript"></script>


<script type="text/javascript">

    
    $(document).ready(function () {

        $('#frmLogin').parsley();

    });

</script>




</body>
</html>