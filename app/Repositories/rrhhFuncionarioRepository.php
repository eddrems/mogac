<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;

use Illuminate\Support\Facades\DB;


class rrhhFuncionarioRepository extends  Repository  {




    function model()
    {
        return 'App\Models\rrhhFuncionario';
    }




    public function buscar_todos_dt($criterio)
    {
        return \DB::table('rrhh_funcionario')
            ->join('rrhh_funcionario_estado', 'rrhh_funcionario.id_funcionario_estado', '=', 'rrhh_funcionario_estado.id_funcionario_estado')
            ->join('rrhh_departamento', 'rrhh_funcionario.id_departamento', '=', 'rrhh_departamento.id_departamento')
            ->join('rrhh_cargo', 'rrhh_funcionario.id_cargo', '=', 'rrhh_cargo.id_cargo')
            ->leftJoin('div_distrito', 'rrhh_funcionario.id_distrito', '=', 'div_distrito.id_distrito')
            ->leftJoin('div_zona', 'rrhh_funcionario.id_zona', '=', 'div_zona.id_zona')
            ->where('rrhh_funcionario.apellidos','like', '%' . $criterio . '%')
            ->orWhere('rrhh_funcionario.nombres','like', '%' . $criterio . '%')
            ->orWhere('rrhh_funcionario.identificacion', $criterio)
            ->orWhere('div_distrito.codigoSemplades', $criterio)
            ->orWhere('div_zona.codigoSemplades', $criterio)
            ->select(
                'rrhh_funcionario.id_funcionario',
                'rrhh_funcionario.identificacion',
                'rrhh_funcionario.apellidos',
                'rrhh_funcionario.nombres',
                'rrhh_funcionario_estado.denominacion as estado',
                'rrhh_departamento.denominacion as departamento',
                'rrhh_cargo.denominacion as cargo',
                'div_distrito.denominacion_institucional as distrito',
                'div_zona.denominacion_institucional as zona',
                'rrhh_funcionario.id_tipo_funcionario'
            )->get();

    }





    public function iniciar_sesion($identificacion, $clave_acceso)
    {

        $existencia = $this->findAllBy('usuario',$identificacion)->count();

        if ($existencia > 0)
        {
            $usuario = $this->with('estado', 'zona', 'distrito')->findBy('usuario', $identificacion);

            if (\Hash::check($clave_acceso, $usuario->clave_acceso))
            {
                if($usuario->estado->puede_iniciar_sesion == 0)
                { return array(0, 'Usuario deshabilitado para iniciar sesión!', \Crypt::encrypt($usuario->id_funcionario)); }

                if($usuario->requiere_cambio_clave == 1)
                { return array(2, 'Debe realizar una actualización de su clave de acceso', \Crypt::encrypt($usuario->id_funcionario)); }
                //{  return Redirect::to('acceso/actualizacion_inicial/' . Crypt::encrypt($user->id_funcionario)); }

                if($usuario->requiere_actualizar_datos_contacto == 1)
                { return array(3, 'Debe realizar una verificación de su información personal', \Crypt::encrypt($usuario->id_funcionario)); }
                //{  return Redirect::to('acceso/actualizacion_info_personal/' . Crypt::encrypt($user->id_funcionario)); }

                $institucion = '';
                switch($usuario->id_tipo_funcionario)
                {
                    case 1:
                        $institucion = $usuario->distrito->denominacion_institucional;
                        break;
                    case 2:
                        $institucion = $usuario->zona->denominacion_institucional;
                        break;
                    case 3:
                        $institucion = 'Planta Central';
                        break;
                }

                return array(1, 'Datos correstos', $usuario, $institucion);
            }else
            {
                return array(0, 'La clave de acceso ingresada es incorrecta!');
            }
        }
        else
        {
            return array(0, 'Identificación y/o clave de acceso incorrectos!');
        }

    }

    public function generar_nueva_clave($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    public function generar_menu_aplicativo($id_funcionario)
    {
        $estados_htm = '';

        $subsistemas = DB::table('config_rol_funcionario')
            ->join('config_rol_modulo', 'config_rol_funcionario.id_rol', '=', 'config_rol_modulo.id_rol')
            ->join('config_modulo', 'config_rol_modulo.id_modulo', '=', 'config_modulo.id_modulo')
            ->join('config_modulosubsistema', 'config_modulo.id_subsistema', '=', 'config_modulosubsistema.id_subsistema')
            ->where('config_rol_funcionario.id_funcionario', $id_funcionario)
            ->select(
                'config_modulosubsistema.id_subsistema',
                'config_modulosubsistema.descripcion',
                'config_modulosubsistema.orden',
                'config_modulosubsistema.icon'
            )
            ->distinct()
            ->orderBy('config_modulosubsistema.orden')
            ->get();

        foreach($subsistemas as $subsistema)
        {
            $estados_htm = $estados_htm
                . '<li >'
                . '<a href="javascript:void(0)" class="auto">'
                . '<span class="pull-right text-muted">'
                . '<i class="i i-circle-sm-o text"></i>'
                . '<i class="i i-circle-sm text-active"></i>'
                . '</span>'
                //. '<b class="badge bg-danger pull-right">4</b>'
                . '<i class="'  . $subsistema->icon . '"></i>'
                . '<span class="font-bold">'  . $subsistema->descripcion . '</span>'
                . '</a>'
                . '<ul class="nav dk">';

            $modulos = DB::table('config_rol_funcionario')
                ->join('config_rol_modulo', 'config_rol_funcionario.id_rol', '=', 'config_rol_modulo.id_rol')
                ->join('config_modulo', 'config_rol_modulo.id_modulo', '=', 'config_modulo.id_modulo')
                ->where('config_rol_funcionario.id_funcionario', $id_funcionario)
                ->where('config_modulo.id_subsistema', $subsistema->id_subsistema)
                ->select(
                    'config_modulo.id_modulo',
                    'config_modulo.descripcion',
                    'config_modulo.texto',
                    'config_modulo.controlador',
                    'config_modulo.accion',
                    'config_modulo.orden',
                    'config_modulo.icon'
                )
                ->distinct()
                ->orderBy('config_modulo.orden')
                ->get();
            foreach($modulos as $modulo)
            {
                $url = url($modulo->controlador .'/'. $modulo->accion);
                $estados_htm = $estados_htm
                    . '<li >'
                    . '<a href="'.$url.'" class="auto">'
                    . '<i class="i i-dot"></i>'
                    . '<span>'  . $modulo->texto . '</span>'
                    . '</a>'
                    . '</li>';
            }

            $estados_htm = $estados_htm . '</ul></li>';

        }

        return $estados_htm;
    }


    public function actualizar_info_inicial($request, $id)
    {

        $funcionario_db = $this->model->find($id);
        $funcionario_db->apellidos = strtoupper($funcionario_db->apellidos);
        $funcionario_db->nombres = strtoupper($funcionario_db->nombres);

        $funcionario_db->id_genero = $request->id_genero;
        $funcionario_db->id_estado_civil = $request->id_estado_civil;
        $funcionario_db->direccion = $request->direccion;
        $funcionario_db->telefono_movil = $request->telefono_movil;
        $funcionario_db->telefono_fijo = $request->telefono_fijo;
        $funcionario_db->correo = $request->correo;

        $funcionario_db->requiere_actualizar_datos_contacto = 0;

        $funcionario_db->save();

        $institucion = '';
        switch($funcionario_db->id_tipo_funcionario)
        {
            case 1:
                $institucion = $funcionario_db->distrito->denominacion_institucional;
                break;
            case 2:
                $institucion = $funcionario_db->zona->denominacion_institucional;
                break;
            case 3:
                $institucion = 'Planta Central';
                break;
        }
        return array(1, 'Datos correstos', $funcionario_db, $institucion);
    }

    public function actualizar_clave_inicial($id, $clave_nueva)
    {

        $funcionario_db = $this->model->find($id);
        $funcionario_db->clave_acceso = $clave_nueva;
        $funcionario_db->requiere_cambio_clave = 0;

        $funcionario_db->save();

        return  $funcionario_db;
    }

    public function actualizar_clave($id, $clave_nueva)
    {

        $funcionario_db = $this->model->find($id);
        $funcionario_db->clave_acceso = $clave_nueva;

        $funcionario_db->save();

        return  $funcionario_db;
    }







}