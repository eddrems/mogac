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






//ROUTES DE CATALOGOS

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












Route::group(['middleware' => ['access_control:56']], function() {

    Route::get('catalogos/casos_ac', 'Catalogos\AtencionCiudadanaCasosController@index');
    Route::get('catalogos/casos_ac/buscar_registros_dt','Catalogos\AtencionCiudadanaCasosController@buscar_registros_dt');

    Route::get('catalogos/casos_ac/crear', 'Catalogos\AtencionCiudadanaCasosController@crear');
    Route::post('catalogos/casos_ac/grabar_nuevo', 'Catalogos\AtencionCiudadanaCasosController@grabar_nuevo');
    Route::get('catalogos/casos_ac/editar/{id}', 'Catalogos\AtencionCiudadanaCasosController@editar');
    Route::post('catalogos/casos_ac/grabar_actualizar', 'Catalogos\AtencionCiudadanaCasosController@grabar_actualizar');
    Route::get('catalogos/casos_ac/eliminar/{id}', 'Catalogos\AtencionCiudadanaCasosController@eliminar');
    Route::post('catalogos/casos_ac/grabar_eliminar', 'Catalogos\AtencionCiudadanaCasosController@grabar_eliminar');

});











