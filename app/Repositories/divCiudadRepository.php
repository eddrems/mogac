<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;


class divCiudadRepository extends  Repository  {




    function model()
    {
        return 'App\Models\divCiudad';
    }

    public function buscar_todos_dt($id_provincia)
    {
        return \DB::table('div_ciudad')
            ->where('id_provincia', $id_provincia)
            ->orderBy('denominacion')
            ->select(
                'id_ciudad',
                'denominacion',
                'codigo'
            );
    }
}