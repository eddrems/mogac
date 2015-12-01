<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;


class rrhhDepartamentoRepository extends  Repository  {




    function model()
    {
        return 'App\Models\rrhhDepartamento';
    }

    public function buscar_todos_dt()
    {
        return \DB::table('rrhh_departamento')
            ->orderBy('denominacion')
            ->select(
                'id_departamento',
                'denominacion',
                'esta_vigente',
                'aplicable_nacional',
                'aplicable_zonal',
                'aplicable_distrito',
                'bloqueado',
                'permite_asignacion_multiple'

            );
    }


}