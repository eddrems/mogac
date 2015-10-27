<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;


class divDistritoRepository extends  Repository  {




    function model()
    {
        return 'App\Models\divDistrito';
    }


    public function buscar_todos_dt()
    {
        return \DB::table('div_distrito')
            ->join('div_parroquia', 'div_distrito.id_parroquia', '=', 'div_parroquia.id_parroquia')
            ->join('div_ciudad', 'div_parroquia.id_ciudad', '=', 'div_ciudad.id_ciudad')
            ->join('div_zona', 'div_distrito.id_zona', '=', 'div_zona.id_zona')
            ->leftJoin('div_circuito', 'div_distrito.id_circuito', '=', 'div_circuito.id_circuito')
            ->select(
                'div_distrito.id_distrito',
                'div_distrito.codigoSemplades',
                'div_distrito.denominacion',
                'div_distrito.denominacion_institucional',
                'div_zona.denominacion as zona',
                \DB::raw('CONCAT(div_parroquia.denominacion, " (", div_ciudad.denominacion, ")") AS ruta'),
                'div_circuito.codigoSemplades as circuito'
            );
    }

}