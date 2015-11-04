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
});


//tabla: aciud_proceso
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

//tabla: div_circuito
Route::group(['middleware' => ['access_control:34']], function() {

    Route::get('catalogos/circuitos', 'Catalogos\GeneralesCircuitosController@index');
    Route::get('catalogos/circuitos/buscar_registros_dt','Catalogos\GeneralesCircuitosController@buscar_registros_dt');
    Route::get('catalogos/circuitos/crear', 'Catalogos\GeneralesCircuitosController@crear');
    Route::post('catalogos/circuitos/grabar_nuevo', 'Catalogos\GeneralesCircuitosController@grabar_nuevo');
    Route::get('catalogos/circuitos/editar/{id}', 'Catalogos\GeneralesCircuitosController@editar');
    Route::post('catalogos/circuitos/grabar_actualizar', 'Catalogos\GeneralesCircuitosController@grabar_actualizar');
    Route::get('catalogos/circuitos/eliminar/{id}', 'Catalogos\GeneralesCircuitosController@eliminar');
    Route::post('catalogos/circuitos/grabar_eliminar', 'Catalogos\GeneralesCircuitosController@grabar_eliminar');
});








//FIN -------------------- MATENIMIENTO DB Y CATALOGACION -----------------------










