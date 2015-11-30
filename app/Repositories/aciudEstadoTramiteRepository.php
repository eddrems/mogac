<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;


class aciudEstadoTramiteRepository extends  Repository  {




    function model()
    {
        return 'App\Models\aciudEstadoTramite';
    }

    public function buscar_todos_dt()
    {
        return \DB::table('aciud_estado_tramite')
            ->select(
                'id_estado_tramite',
                'orden',
                'denominacion',
                'css_color',
                'css_label_class',
                'letra',
                'permite_edicion',
                'proceso_terminado',
                'permite_cambio_manual',
                'permite_traslado_distrito'
            );
    }
}