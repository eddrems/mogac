<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;


class aciudServicioRepository extends  Repository  {




    function model()
    {
        return 'App\Models\aciudServicio';
    }



    public function buscar_todos_dt()
    {
        return \DB::table('aciud_cat_servicio')
            ->select(
                'aciud_cat_servicio.id_servicio',
                'aciud_cat_servicio.denominacion'
            );
    }


}