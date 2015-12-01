<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;


class rrhhCargoRepository extends  Repository  {




    function model()
    {
        return 'App\Models\rrhhCargo';
    }


    public function buscar_todos_dt()
    {
        return \DB::table('rrhh_cargo')
            ->orderBy('denominacion')
            ->select(
                'id_cargo',
                'denominacion',
                'aplicable_personas',
                'aplicable_funcionarios',
                'aplicable_nacional',
                'aplicable_zonal',
                'aplicable_distrito',
                'valida_traslados_tramite_distritos',
                'id_rol_predeterminado'
            );
    }


}