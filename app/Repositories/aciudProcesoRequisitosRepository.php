<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;


class aciudProcesoRequisitosRepository extends  Repository  {




    function model()
    {
        return 'App\Models\aciudProcesoRequisitos';
    }


    public function buscar_todos_dt($id_proceso)
    {
        return \DB::table('aciud_proceso_requisitos')
            ->where('id_proceso', $id_proceso)
            ->select(
                'id_requisitos',
                'id_proceso',
                'nombre',
                'observaciones'
            );
    }
}