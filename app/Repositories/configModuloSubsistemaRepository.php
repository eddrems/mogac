<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;


class configModuloSubsistemaRepository extends  Repository  {




    function model()
    {
        return 'App\Models\configModuloSubsistema';
    }


    public function buscar_todos_dt()
    {
        return \DB::table('config_modulosubsistema')
            ->select(
                'id_subsistema',
                'descripcion',
                'esta_activo',
                'orden',
                'icon'
            );
    }

}