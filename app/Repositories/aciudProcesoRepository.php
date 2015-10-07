<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;


class aciudProcesoRepository extends  Repository  {




    function model()
    {
        return 'App\Models\aciudProceso';
    }


    public function buscar_todos_dt()
    {
        return \DB::table('aciud_proceso')
            ->join('aciud_cat_caso', 'aciud_proceso.id_caso', '=', 'aciud_cat_caso.id_caso')
            ->join('aciud_cat_servicio', 'aciud_cat_caso.id_servicio', '=', 'aciud_cat_servicio.id_servicio')
            ->join('rrhh_departamento', 'aciud_proceso.id_departamento', '=', 'rrhh_departamento.id_departamento')
            ->select(
                'aciud_cat_servicio.denominacion as servicio',
                'aciud_cat_caso.denominacion as caso',
                'rrhh_departamento.denominacion as departamento',
                'aciud_proceso.id_proceso',
                'aciud_proceso.denominacion',
                'aciud_proceso.tiempo',
                'aciud_proceso.activo_recepcion',
                'aciud_proceso.incluir_matriz_snap'
            );
    }




}