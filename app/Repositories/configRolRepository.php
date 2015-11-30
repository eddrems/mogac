<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;


class configRolRepository extends  Repository  {




    function model()
    {
        return 'App\Models\configRol';
    }

    public function buscar_todos_dt()
    {
        return \DB::table('config_rol')
            ->select(
                'id_rol',
                'denominacion',
                'denominacion_visual',
                'predefinido_modulo_id',
                'esta_vigente',
                'nivel_nacional',
                'nivel_zonal',
                'nivel_distrital'
            );
    }
}