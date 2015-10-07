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
            <div class="col-md-4 col-md-offset-4 m-t-lg" style="margin-top: 0px;">
                <section class="panel bg-light lt" >
                    <header class="panel-heading bg bg-primary lt text-center" style="font-size: 14pt;">Cambiar Clave de Acceso</header>
                    {{ Form::open(array('url' => 'acceso/mkActualizarReseteo', 'id' => 'frmLogin', 'class' => 'panel-body')) }}

                    {{ Form::hidden('token_cambio', Crypt::encrypt($token)) }}
                    <div class="form-group">
                        <label class="control-label">Nueva Clave:</label>
                        <input type="password" name="nueva_clave" id="nueva_clave" class="form-control" data-required="true" data-rangelength="[0,20]">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Confirmar Nueva Clave:</label><br>
                        <input type="password" name="nueva_clave_confirmacion" id="nueva_clave_confirmacion" class="form-control" data-required="true" data-rangelength="[0,20]" data-equalto = "#nueva_clave">
                    </div>
                        @if (Session::has('message'))
                            <div class="alert alert-danger alert-block"> 
                                <button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button> 
                                <p>{{ Session::get('message') }}</p> 
                            </div>        
                        @endif                        
                        <button type="submit" class="btn btn-block btn-primary btn-lg">Aceptar</button>
                        <p class="text-muted text-center" style="margin-top: 10px; margin-bottom: 0px;"><small><a href="{{ URL::to('acceso/') }}">Cancelar</a></small></p>
                    {{ Form::close() }}
                </section>

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