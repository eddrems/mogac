<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;


class aciudTramiteResultadoRepository extends  Repository  {




    function model()
    {
        return 'App\Models\aciudTramiteResultado';
    }

    public function buscar_todos_dt()
    {
        return \DB::table('aciud_tramite_resultado')
            ->select(
                'id_tramite_resultado',
                'denominacion',
                'requiere_observaciones'
            );
    }

}