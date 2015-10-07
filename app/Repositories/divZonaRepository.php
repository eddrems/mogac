<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;


class divZonaRepository extends  Repository  {

    function model()
    {
        return 'App\Models\divZona';
    }



    public function buscar_todos_dt()
    {
        return \DB::table('div_zona')
            ->select(
                'div_zona.id_zona',
                'div_zona.codigoSemplades',
                'div_zona.denominacion',
                'div_zona.denominacion_institucional'
            );
    }
}