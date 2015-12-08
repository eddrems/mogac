<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



//ROUTES DE AUTENTICACION Y SERVICIOS DE PERFIL
Route::get('/', 'Acceso\AccesoController@login');
Route::get('acceso', 'Acceso\AccesoController@login');
Route::post('acceso/iniciar_sesion', 'Acceso\AccesoController@iniciar_sesion');
Route::get('cerrar_sesion', 'Acceso\AccesoController@cerrar_sesion');

Route::get('acceso/actualizar_clave_inicial/{id?}', 'Acceso\AccesoController@actualizar_clave_inicial');
Route::post('acceso/grabar_actualizar_clave_inicial', 'Acceso\AccesoController@grabar_actualizar_clave_inicial');

Route::get('acceso/actualizar_info_personal/{id?}', 'Acceso\AccesoController@actualizar_info_personal');
Route::post('acceso/grabar_actualizar_info_personal', 'Acceso\AccesoController@grabar_actualizar_info_personal');


Route::group(['middleware' => ['auth']], function() {
    Route::get('inicio', 'Acceso\AccesoController@inicio');
    Route::get('perfil/actualizar_clave_acceso', 'Acceso\AccesoController@actualizar_clave_acceso');
    Route::post('perfil/grabar_actualizar_clave_acceso', 'Acceso\AccesoController@grabar_actualizar_clave_acceso');


});












// MATENIMIENTO DB Y CATALOGACION

//tabla: aciud_cat_caso
Route::group(['middleware' => ['access_control:23']], function() {

    Route::get('catalogos/casos_ac', 'Catalogos\AtencionCiudadanaCasosController@index');
    Route::get('catalogos/casos_ac/buscar_registros_dt','Catalogos\AtencionCiudadanaCasosController@buscar_registros_dt');
    Route::get('catalogos/casos_ac/crear', 'Catalogos\AtencionCiudadanaCasosController@crear');
    Route::post('catalogos/casos_ac/grabar_nuevo', 'Catalogos\AtencionCiudadanaCasosController@grabar_nuevo');
    Route::get('catalogos/casos_ac/editar/{id}', 'Catalogos\AtencionCiudadanaCasosController@editar');
    Route::post('catalogos/casos_ac/grabar_actualizar', 'Catalogos\AtencionCiudadanaCasosController@grabar_actualizar');
    Route::get('catalogos/casos_ac/eliminar/{id}', 'Catalogos\AtencionCiudadanaCasosController@eliminar');
    Route::post('catalogos/casos_ac/grabar_eliminar', 'Catalogos\AtencionCiudadanaCasosController@grabar_eliminar');
});
//tabla: aciud_cat_servicio
Route::group(['middleware' => ['access_control:22']], function() {

    Route::get('catalogos/servicios_ac', 'Catalogos\AtencionCiudadanaServiciosController@index');
    Route::get('catalogos/servicios_ac/buscar_registros_dt','Catalogos\AtencionCiudadanaServiciosController@buscar_registros_dt');
    Route::get('catalogos/servicios_ac/crear', 'Catalogos\AtencionCiudadanaServiciosController@crear');
    Route::post('catalogos/servicios_ac/grabar_nuevo', 'Catalogos\AtencionCiudadanaServiciosController@grabar_nuevo');
    Route::get('catalogos/servicios_ac/editar/{id}', 'Catalogos\AtencionCiudadanaServiciosController@editar');
    Route::post('catalogos/servicios_ac/grabar_actualizar', 'Catalogos\AtencionCiudadanaServiciosController@grabar_actualizar');
    Route::get('catalogos/servicios_ac/eliminar/{id}', 'Catalogos\AtencionCiudadanaServiciosController@eliminar');
    Route::post('catalogos/servicios_ac/grabar_eliminar', 'Catalogos\AtencionCiudadanaServiciosController@grabar_eliminar');
});
//tabla: aciud_estado_tramite
Route::group(['middleware' => ['access_control:22']], function() {

    Route::get('catalogos/tramites_estado', 'Catalogos\AtencionCiudadanaTramiteEstadosController@index');
    Route::get('catalogos/tramites_estado/buscar_registros_dt','Catalogos\AtencionCiudadanaTramiteEstadosController@buscar_registros_dt');
    Route::get('catalogos/tramites_estado/crear', 'Catalogos\AtencionCiudadanaTramiteEstadosController@crear');
    Route::post('catalogos/tramites_estado/grabar_nuevo', 'Catalogos\AtencionCiudadanaTramiteEstadosController@grabar_nuevo');
    Route::get('catalogos/tramites_estado/editar/{id}', 'Catalogos\AtencionCiudadanaTramiteEstadosController@editar');
    Route::post('catalogos/tramites_estado/grabar_actualizar', 'Catalogos\AtencionCiudadanaTramiteEstadosController@grabar_actualizar');
    Route::get('catalogos/tramites_estado/eliminar/{id}', 'Catalogos\AtencionCiudadanaTramiteEstadosController@eliminar');
    Route::post('catalogos/tramites_estado/grabar_eliminar', 'Catalogos\AtencionCiudadanaTramiteEstadosController@grabar_eliminar');
});
//tabla: aciud_proceso
Route::group(['middleware' => ['access_control:24']], function() {

    Route::get('catalogos/procesos_ac', 'Catalogos\AtencionCiudadanaProcesosController@index');
    Route::get('catalogos/procesos_ac/buscar_registros_dt','Catalogos\AtencionCiudadanaProcesosController@buscar_registros_dt');
    Route::get('catalogos/procesos_ac/crear', 'Catalogos\AtencionCiudadanaProcesosController@crear');
    Route::post('catalogos/procesos_ac/grabar_nuevo', 'Catalogos\AtencionCiudadanaProcesosController@grabar_nuevo');
    Route::get('catalogos/procesos_ac/editar/{id}', 'Catalogos\AtencionCiudadanaProcesosController@editar');
    Route::post('catalogos/procesos_ac/grabar_actualizar', 'Catalogos\AtencionCiudadanaProcesosController@grabar_actualizar');
    Route::get('catalogos/procesos_ac/eliminar/{id}', 'Catalogos\AtencionCiudadanaProcesosController@eliminar');
    Route::post('catalogos/procesos_ac/grabar_eliminar', 'Catalogos\AtencionCiudadanaProcesosController@grabar_eliminar');


    Route::get('catalogos/procesos_ac/requisitos/listar/{id_proceso}', 'Catalogos\AtencionCiudadanaProcesosReuqerimientosController@listar');
    Route::get('catalogos/procesos_ac/requisitos/buscar_registros_dt/{id_proceso}','Catalogos\AtencionCiudadanaProcesosReuqerimientosController@buscar_registros_dt');
    Route::get('catalogos/procesos_ac/requisitos/crear/{id_proceso}', 'Catalogos\AtencionCiudadanaProcesosReuqerimientosController@crear');
    Route::post('catalogos/procesos_ac/requisitos/grabar_nuevo', 'Catalogos\AtencionCiudadanaProcesosReuqerimientosController@grabar_nuevo');
    Route::get('catalogos/procesos_ac/requisitos/editar/{id}', 'Catalogos\AtencionCiudadanaProcesosReuqerimientosController@editar');
    Route::post('catalogos/procesos_ac/requisitos/grabar_actualizar', 'Catalogos\AtencionCiudadanaProcesosReuqerimientosController@grabar_actualizar');
    Route::get('catalogos/procesos_ac/requisitos/eliminar/{id}', 'Catalogos\AtencionCiudadanaProcesosReuqerimientosController@eliminar');
    Route::post('catalogos/procesos_ac/requisitos/grabar_eliminar', 'Catalogos\AtencionCiudadanaProcesosReuqerimientosController@grabar_eliminar');
    
});
//tabla: aciud_estado_tramite
Route::group(['middleware' => ['access_control:22']], function() {

    Route::get('catalogos/tramites_resultado', 'Catalogos\AtencionCiudadanaTramiteResultadosController@index');
    Route::get('catalogos/tramites_resultado/buscar_registros_dt','Catalogos\AtencionCiudadanaTramiteResultadosController@buscar_registros_dt');
    Route::get('catalogos/tramites_resultado/crear', 'Catalogos\AtencionCiudadanaTramiteResultadosController@crear');
    Route::post('catalogos/tramites_resultado/grabar_nuevo', 'Catalogos\AtencionCiudadanaTramiteResultadosController@grabar_nuevo');
    Route::get('catalogos/tramites_resultado/editar/{id}', 'Catalogos\AtencionCiudadanaTramiteResultadosController@editar');
    Route::post('catalogos/tramites_resultado/grabar_actualizar', 'Catalogos\AtencionCiudadanaTramiteResultadosController@grabar_actualizar');
    Route::get('catalogos/tramites_resultado/eliminar/{id}', 'Catalogos\AtencionCiudadanaTramiteResultadosController@eliminar');
    Route::post('catalogos/tramites_resultado/grabar_eliminar', 'Catalogos\AtencionCiudadanaTramiteResultadosController@grabar_eliminar');
});
//tabla: config_modulo  config_modulosubsistema
Route::group(['middleware' => ['access_control:22']], function() {

    Route::get('seguridades/modulos', 'Seguridades\ModulosAgrupacionesController@index');
    Route::get('seguridades/modulos/buscar_registros_dt','Seguridades\ModulosAgrupacionesController@buscar_registros_dt');
    Route::get('seguridades/modulos/crear', 'Seguridades\ModulosAgrupacionesController@crear');
    Route::post('seguridades/modulos/grabar_nuevo', 'Seguridades\ModulosAgrupacionesController@grabar_nuevo');
    Route::get('seguridades/modulos/editar/{id}', 'Seguridades\ModulosAgrupacionesController@editar');
    Route::post('seguridades/modulos/grabar_actualizar', 'Seguridades\ModulosAgrupacionesController@grabar_actualizar');
    Route::get('seguridades/modulos/eliminar/{id}', 'Seguridades\ModulosAgrupacionesController@eliminar');
    Route::post('seguridades/modulos/grabar_eliminar', 'Seguridades\ModulosAgrupacionesController@grabar_eliminar');

    Route::get('seguridades/modulos/detalles/listar/{id_subsistema}', 'Seguridades\ModulosController@listar');
    Route::get('seguridades/modulos/detalles/buscar_registros_dt/{id_subsistema}','Seguridades\ModulosController@buscar_registros_dt');
    Route::get('seguridades/modulos/detalles/crear/{id_subsistema}', 'Seguridades\ModulosController@crear');
    Route::post('seguridades/modulos/detalles/grabar_nuevo', 'Seguridades\ModulosController@grabar_nuevo');
    Route::get('seguridades/modulos/detalles/editar/{id}', 'Seguridades\ModulosController@editar');
    Route::post('seguridades/modulos/detalles/grabar_actualizar', 'Seguridades\ModulosController@grabar_actualizar');
    Route::get('seguridades/modulos/detalles/eliminar/{id}', 'Seguridades\ModulosController@eliminar');
    Route::post('seguridades/modulos/detalles/grabar_eliminar', 'Seguridades\ModulosController@grabar_eliminar');
});
//tabla: config_rol   config_rol_modulo
Route::group(['middleware' => ['access_control:22']], function() {

    Route::get('seguridades/roles', 'Seguridades\RolesController@index');
    Route::get('seguridades/roles/buscar_registros_dt','Seguridades\RolesController@buscar_registros_dt');
    Route::get('seguridades/roles/crear', 'Seguridades\RolesController@crear');
    Route::post('seguridades/roles/grabar_nuevo', 'Seguridades\RolesController@grabar_nuevo');
    Route::get('seguridades/roles/editar/{id}', 'Seguridades\RolesController@editar');
    Route::post('seguridades/roles/grabar_actualizar', 'Seguridades\RolesController@grabar_actualizar');
    Route::get('seguridades/roles/eliminar/{id}', 'Seguridades\RolesController@eliminar');
    Route::post('seguridades/roles/grabar_eliminar', 'Seguridades\RolesController@grabar_eliminar');
    
    Route::get('seguridades/roles/permisos/listar/{id_rol}', 'Seguridades\RolesPermisosController@listar');
    Route::get('seguridades/roles/permisos/buscar_registros_dt/{id_rol}','Seguridades\RolesPermisosController@buscar_registros_dt');
    Route::get('seguridades/roles/permisos/crear/{id_rol}', 'Seguridades\RolesPermisosController@crear');
    Route::post('seguridades/roles/permisos/grabar_nuevo', 'Seguridades\RolesPermisosController@grabar_nuevo');
    Route::get('seguridades/roles/permisos/eliminar/{id}', 'Seguridades\RolesPermisosController@eliminar');
    Route::post('seguridades/roles/permisos/grabar_eliminar', 'Seguridades\RolesPermisosController@grabar_eliminar');
});
//tabla: div_provincia   div_ciudad   div_parroquia
Route::group(['middleware' => ['access_control:22']], function() {

    Route::get('catalogos/provincias', 'Catalogos\GeneralesProvinciasController@index');
    Route::get('catalogos/provincias/buscar_registros_dt','Catalogos\GeneralesProvinciasController@buscar_registros_dt');
    Route::get('catalogos/provincias/crear', 'Catalogos\GeneralesProvinciasController@crear');
    Route::post('catalogos/provincias/grabar_nuevo', 'Catalogos\GeneralesProvinciasController@grabar_nuevo');
    Route::get('catalogos/provincias/editar/{id}', 'Catalogos\GeneralesProvinciasController@editar');
    Route::post('catalogos/provincias/grabar_actualizar', 'Catalogos\GeneralesProvinciasController@grabar_actualizar');
    Route::get('catalogos/provincias/eliminar/{id}', 'Catalogos\GeneralesProvinciasController@eliminar');
    Route::post('catalogos/provincias/grabar_eliminar', 'Catalogos\GeneralesProvinciasController@grabar_eliminar');


    Route::get('catalogos/ciudades/listar/{id_provincia}', 'Catalogos\GeneralesCiduadesController@index');
    Route::get('catalogos/ciudades/buscar_registros_dt/{id_provincia}','Catalogos\GeneralesCiduadesController@buscar_registros_dt');
    Route::get('catalogos/ciudades/crear/{id_provincia}', 'Catalogos\GeneralesCiduadesController@crear');
    Route::post('catalogos/ciudades/grabar_nuevo', 'Catalogos\GeneralesCiduadesController@grabar_nuevo');
    Route::get('catalogos/ciudades/editar/{id}', 'Catalogos\GeneralesCiduadesController@editar');
    Route::post('catalogos/ciudades/grabar_actualizar', 'Catalogos\GeneralesCiduadesController@grabar_actualizar');
    Route::get('catalogos/ciudades/eliminar/{id}', 'Catalogos\GeneralesCiduadesController@eliminar');
    Route::post('catalogos/ciudades/grabar_eliminar', 'Catalogos\GeneralesCiduadesController@grabar_eliminar');


    Route::get('catalogos/parroquias/listar/{id_provincia}', 'Catalogos\GeneralesParroquiasController@index');
    Route::get('catalogos/parroquias/buscar_registros_dt/{id_provincia}','Catalogos\GeneralesParroquiasController@buscar_registros_dt');
    Route::get('catalogos/parroquias/crear/{id_provincia}', 'Catalogos\GeneralesParroquiasController@crear');
    Route::post('catalogos/parroquias/grabar_nuevo', 'Catalogos\GeneralesParroquiasController@grabar_nuevo');
    Route::get('catalogos/parroquias/editar/{id}', 'Catalogos\GeneralesParroquiasController@editar');
    Route::post('catalogos/parroquias/grabar_actualizar', 'Catalogos\GeneralesParroquiasController@grabar_actualizar');
    Route::get('catalogos/parroquias/eliminar/{id}', 'Catalogos\GeneralesParroquiasController@eliminar');
    Route::post('catalogos/parroquias/grabar_eliminar', 'Catalogos\GeneralesParroquiasController@grabar_eliminar');
    
});
//tabla: div_circuito
Route::group(['middleware' => ['access_control:35']], function() {

    Route::get('catalogos/circuitos', 'Catalogos\GeneralesCircuitosController@index');
    Route::get('catalogos/circuitos/buscar_registros_dt','Catalogos\GeneralesCircuitosController@buscar_registros_dt');
    Route::get('catalogos/circuitos/crear', 'Catalogos\GeneralesCircuitosController@crear');
    Route::post('catalogos/circuitos/grabar_nuevo', 'Catalogos\GeneralesCircuitosController@grabar_nuevo');
    Route::get('catalogos/circuitos/editar/{id}', 'Catalogos\GeneralesCircuitosController@editar');
    Route::post('catalogos/circuitos/grabar_actualizar', 'Catalogos\GeneralesCircuitosController@grabar_actualizar');
    Route::get('catalogos/circuitos/eliminar/{id}', 'Catalogos\GeneralesCircuitosController@eliminar');
    Route::post('catalogos/circuitos/grabar_eliminar', 'Catalogos\GeneralesCircuitosController@grabar_eliminar');
});
//tabla: div_distrito
Route::group(['middleware' => ['access_control:34']], function() {

    Route::get('catalogos/distritos', 'Catalogos\GeneralesDistritosController@index');
    Route::get('catalogos/distritos/buscar_registros_dt','Catalogos\GeneralesDistritosController@buscar_registros_dt');
    Route::get('catalogos/distritos/crear', 'Catalogos\GeneralesDistritosController@crear');
    Route::post('catalogos/distritos/grabar_nuevo', 'Catalogos\GeneralesDistritosController@grabar_nuevo');
    Route::get('catalogos/distritos/editar/{id}', 'Catalogos\GeneralesDistritosController@editar');
    Route::post('catalogos/distritos/grabar_actualizar', 'Catalogos\GeneralesDistritosController@grabar_actualizar');
    Route::get('catalogos/distritos/eliminar/{id}', 'Catalogos\GeneralesDistritosController@eliminar');
    Route::post('catalogos/distritos/grabar_eliminar', 'Catalogos\GeneralesDistritosController@grabar_eliminar');
});
//tabla: div_zona
Route::group(['middleware' => ['access_control:33']], function() {

    Route::get('catalogos/zonas', 'Catalogos\GeneralesZonasController@index');
    Route::get('catalogos/zonas/buscar_registros_dt','Catalogos\GeneralesZonasController@buscar_registros_dt');
    Route::get('catalogos/zonas/crear', 'Catalogos\GeneralesZonasController@crear');
    Route::post('catalogos/zonas/grabar_nuevo', 'Catalogos\GeneralesZonasController@grabar_nuevo');
    Route::get('catalogos/zonas/editar/{id}', 'Catalogos\GeneralesZonasController@editar');
    Route::post('catalogos/zonas/grabar_actualizar', 'Catalogos\GeneralesZonasController@grabar_actualizar');
    Route::get('catalogos/zonas/eliminar/{id}', 'Catalogos\GeneralesZonasController@eliminar');
    Route::post('catalogos/zonas/grabar_eliminar', 'Catalogos\GeneralesZonasController@grabar_eliminar');
});
//tabla: div_institucion_educativa
Route::group(['middleware' => ['access_control:34']], function() {

    Route::get('catalogos/ies', 'Catalogos\GeneralesInsticionesEducativasController@index');
    Route::get('catalogos/ies/buscar_registros_dt','Catalogos\GeneralesInsticionesEducativasController@buscar_registros_dt');
    Route::get('catalogos/ies/crear', 'Catalogos\GeneralesInsticionesEducativasController@crear');
    Route::post('catalogos/ies/grabar_nuevo', 'Catalogos\GeneralesInsticionesEducativasController@grabar_nuevo');
    Route::get('catalogos/ies/editar/{id}', 'Catalogos\GeneralesInsticionesEducativasController@editar');
    Route::post('catalogos/ies/grabar_actualizar', 'Catalogos\GeneralesInsticionesEducativasController@grabar_actualizar');
    Route::get('catalogos/ies/eliminar/{id}', 'Catalogos\GeneralesInsticionesEducativasController@eliminar');
    Route::post('catalogos/ies/grabar_eliminar', 'Catalogos\GeneralesInsticionesEducativasController@grabar_eliminar');
});
//tabla: rrhh_cargo
Route::group(['middleware' => ['access_control:34']], function() {

    Route::get('catalogos/cargos_funcionarios', 'Catalogos\PersonalCargoController@index');
    Route::get('catalogos/cargos_funcionarios/buscar_registros_dt','Catalogos\PersonalCargoController@buscar_registros_dt');
    Route::get('catalogos/cargos_funcionarios/crear', 'Catalogos\PersonalCargoController@crear');
    Route::post('catalogos/cargos_funcionarios/grabar_nuevo', 'Catalogos\PersonalCargoController@grabar_nuevo');
    Route::get('catalogos/cargos_funcionarios/editar/{id}', 'Catalogos\PersonalCargoController@editar');
    Route::post('catalogos/cargos_funcionarios/grabar_actualizar', 'Catalogos\PersonalCargoController@grabar_actualizar');
    Route::get('catalogos/cargos_funcionarios/eliminar/{id}', 'Catalogos\PersonalCargoController@eliminar');
    Route::post('catalogos/cargos_funcionarios/grabar_eliminar', 'Catalogos\PersonalCargoController@grabar_eliminar');
});
//tabla: rrhh_departamento
Route::group(['middleware' => ['access_control:34']], function() {

    Route::get('catalogos/departamentos_funcionarios', 'Catalogos\PersonalDepartamentosController@index');
    Route::get('catalogos/departamentos_funcionarios/buscar_registros_dt','Catalogos\PersonalDepartamentosController@buscar_registros_dt');
    Route::get('catalogos/departamentos_funcionarios/crear', 'Catalogos\PersonalDepartamentosController@crear');
    Route::post('catalogos/departamentos_funcionarios/grabar_nuevo', 'Catalogos\PersonalDepartamentosController@grabar_nuevo');
    Route::get('catalogos/departamentos_funcionarios/editar/{id}', 'Catalogos\PersonalDepartamentosController@editar');
    Route::post('catalogos/departamentos_funcionarios/grabar_actualizar', 'Catalogos\PersonalDepartamentosController@grabar_actualizar');
    Route::get('catalogos/departamentos_funcionarios/eliminar/{id}', 'Catalogos\PersonalDepartamentosController@eliminar');
    Route::post('catalogos/departamentos_funcionarios/grabar_eliminar', 'Catalogos\PersonalDepartamentosController@grabar_eliminar');
});
//tabla: rrhh_funcionario
Route::group(['middleware' => ['access_control:34']], function() {

    Route::get('usuarios/gestion', 'Usuarios\GestionUsuariosController@index');
    Route::get('usuarios/gestion/buscar_registros_dt/{criterio}','Usuarios\GestionUsuariosController@buscar_registros_dt');
    Route::get('usuarios/gestion/buscar_dependencias_nu', 'Usuarios\GestionUsuariosController@buscar_dependencias_nu');
    Route::get('usuarios/gestion/buscar_dependencias_nu_por_tipo_funcionario/{id_tipo_funcionario}', 'Usuarios\GestionUsuariosController@buscar_dependencias_nu_por_tipo_funcionario');
});






//FIN -------------------- MATENIMIENTO DB Y CATALOGACION -----------------------










