@extends('layouts.plantilla_ui_general')

@section('Metas')
    <meta id="token" name="token" value="{{ csrf_token() }}">
@endsection


@section('content')



    <section class="vbox" id="modulo">
        <header class="header b-b bg-white hidden-print">
            <button class="btn btn-primary btn-sm  pull-right" v-on:click="agregar_usuario()" style="margin-right:5px; " >Nuevo Registro</button>
            <p style="font-size: medium;"><i class="fa fa-users"></i> Usuarios / <strong> Gestión</strong></p>
            <input type="hidden" v-model="url_base" value="{{ url('usuarios/gestion') }}">
        </header>

        <section class="scrollable wrapper">


            <section class="panel panel-primary">
                <section class="panel-body">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="ingrese criterio de búsqueda" v-model="criterio_busqueda">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="button" v-on:click="buscar_usuarios()"><i class="fa fa-search"></i> Buscar</button>
                        </span>
                    </div>
                </section>
            </section>



            <section class="panel panel-primary" v-if="busqueda_inicializada">
                <header class="panel-heading">
                    Resultados <span class="badge bg-warning ">@{{ usuarios_encontados.length }}</span>
                </header>
                <div class="table-responsive" v-if="usuarios_encontados.length > 0">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 420px;">Funcionario</th>
                                <th>Cargo / Deaprtamento</th>
                                <th style="width: 100px;">Estado</th>
                                <th style="width: 120px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="usuario in usuarios_encontados">
                                <td>
                                    @{{ usuario.nombres }} @{{ usuario.apellidos }} &nbsp;&nbsp;&nbsp; <i class="fa fa-credit-card"></i> <strong>@{{ usuario.identificacion }}</strong> <br>
                                    <small style="font-size: 10px; font-weight: bold;" v-if="usuario.id_tipo_funcionario == 1"><i class="fa fa-home"></i> @{{ usuario.distrito }}</small>
                                    <small style="font-size: 10px; font-weight: bold;" v-if="usuario.id_tipo_funcionario == 2"><i class="fa fa-home"></i> @{{ usuario.zona }}</small>
                                    <small style="font-size: 10px; font-weight: bold;" v-if="usuario.id_tipo_funcionario == 3"><i class="fa fa-home"></i> Planta Central</small>
                                </td>
                                <td>
                                    <small style="font-size: 10px;">
                                        <i class="fa fa-book"></i> @{{ usuario.departamento }}<br>
                                        <i class="fa fa-briefcase"></i> @{{ usuario.cargo }}
                                    </small>
                                </td>
                                <td>@{{ usuario.estado  }}</td>
                                <td class="">
                                    <a href="http://atencionciudadana.educacion.gob.ec/config_gestion_colaboradores_nacional/editar_distrital/??"><i class="fa fa-pencil"></i></a>
                                    &nbsp;<a href="http://atencionciudadana.educacion.gob.ec/config_asignar_roles/index/??"><i class="fa fa-cog"></i></a>
                                    &nbsp;<a href="http://atencionciudadana.educacion.gob.ec/config_gestion_colaboradores_nacional/asignar_departamentos_adicionales/???"><i class="fa fa-sitemap"></i></a>
                                    &nbsp;&nbsp;&nbsp;<a href="http://atencionciudadana.educacion.gob.ec/config_gestion_colaboradores_nacional/resetpwspc/??"><i class="fa fa-unlock"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </section>



        </section>




        <div class="modal" id="nuevoUsuario" tabindex="-1"  role="dialog">
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="modal-header"> <button type="button" class="close" data-dismiss="modal">×</button> <h4 class="modal-title">Crear Usuario
                            <img src="{{ asset('frontend/img_ui/page-loader.gif') }}" style="width: 27px;" v-if="loading_ventana_usuario">
                        </h4> </div>
                    <div class="modal-body">
                        {!! Form::open(array('url' => 'seguridades/modulos/detalles/grabar_nuevo', 'id' => 'frmMain')) !!}
                            <div class="row">
                                <div class="col-lg-6 b-r">
                                    <div class="form-group">
                                        <label  class="control-label">Tipo de Usuario:</label>
                                        <select name="id_tipo_funcionario" class="form-control" v-model="nuevo_usuario.id_tipo_funcionario" v-on:change="agregar_usuario_depedencias_por_tipo()">
                                            <option v-for="tu in dep_tus" value="@{{ tu.id_tipo_funcionario }}">@{{ tu.denominacion }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label  control-label">Identificado Por:</label>
                                        <select name="id_tipo_identificacion" class="form-control" v-model="nuevo_usuario.id_tipo_identificacion">
                                            <option v-for="ti in dep_tis" value="@{{ ti.id_tipo_identificacion }}">@{{ ti.denominacion }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label  control-label">Identificación:</label>
                                        <div class="input-group">
                                            <input type="text" name="identificacion" class="form-control" v-model="nuevo_usuario.identificacion">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary" type="button" v-on:click="importar_ws()"><i class="fa fa-search"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  control-label">Apellidos:</label>
                                        <input type="text" name="apellidos" class="form-control" v-model="nuevo_usuario.apellidos">
                                    </div>
                                    <div class="form-group">
                                        <label  control-label">Nombres:</label>
                                        <input type="text" name="nombres" class="form-control" v-model="nuevo_usuario.nombres">
                                    </div>
                                    <div class="form-group">
                                        <label  control-label">Género:</label>
                                        <select name="id_tipo_identificacion" class="form-control" v-model="nuevo_usuario.id_genero">
                                            <option v-for="ge in dep_generos" value="@{{ ge.id_genero }}">@{{ ge.denominacion }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group" v-if="nuevo_usuario.id_tipo_funcionario == 2">
                                        <label  control-label">Zona:</label>
                                        <select name="id_zona" class="form-control" v-model="nuevo_usuario.id_zona">
                                            <option v-for="zn in dep_zonas" value="@{{ zn.id_zona }}">@{{ zn.denominacion_institucional }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group" v-if="nuevo_usuario.id_tipo_funcionario == 1">
                                        <label  control-label">Distrito:</label>
                                        <select name="id_distrito" class="form-control" v-model="nuevo_usuario.id_distrito">
                                            <option v-for="cr in dep_distritos" value="@{{ cr.id_distrito }}">@{{ cr.denominacion_institucional }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label  control-label">Departamento:</label>
                                        <select name="id_departamento" class="form-control" v-model="nuevo_usuario.id_departamento">
                                            <option v-for="dp in dep_departamentos" value="@{{ dp.id_departamento }}">@{{ dp.denominacion }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label  control-label">Cargo:</label>
                                        <select name="id_cargo" class="form-control" v-model="nuevo_usuario.id_cargo">
                                            <option v-for="cr in dep_cargos" value="@{{ cr.id_cargo }}">@{{ cr.denominacion }}</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        {!! Form::close()!!}

                    </div>
                </div>
            </div>
        </div>

    </section>


@stop



@section('Dependencias_CSS')


@endsection



@section('Dependencias_JS')


    <script src="{{ asset('frontend/assets/vue/vue.js') }}"></script>
    <script src="{{ asset('frontend/assets/vue/vue-resource.js') }}"></script>


    <script src="{{ asset('apps_js/personal/personal_gestion.js') }}"></script>


@endsection



@section('js_code')




    <script type="text/javascript">


        $(document).ready(function () {

            $("#nav").addClass("nav-xs");

        });

    </script>


@stop


