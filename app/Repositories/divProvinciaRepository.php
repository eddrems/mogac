<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;


class divProvinciaRepository extends  Repository  {




    function model()
    {
        return 'App\Models\divProvincia';
    }


    public function buscar_todos_dt()
    {
        return \DB::table('div_provincia')
            ->orderBy('denominacion')
            ->select(
                'id_provincia',
                'denominacion',
                'codigo'
            );
    }
}