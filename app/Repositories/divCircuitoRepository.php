<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;


class divCircuitoRepository extends  Repository  {




    function model()
    {
        return 'App\Models\divCircuito';
    }

    public function bucar_cicuitos_por_distrito_lists($id_distrito)
    {
        return \DB::table('div_circuito')
            ->where('id_distrito', $id_distrito)
            ->orderBy('codigoSemplades')
            ->select(\DB::raw('CONCAT(codigoSemplades, " (", composicion, ")") AS denominacion'), 'id_circuito')
            ->lists('denominacion', 'id_circuito');
    }


    public function buscar_todos_dt()
    {
        return \DB::table('div_circuito')
            ->join('div_distrito', 'div_circuito.id_distrito', '=', 'div_distrito.id_distrito')
            ->join('div_zona', 'div_distrito.id_zona', '=', 'div_zona.id_zona')
            ->select(
                'div_circuito.id_circuito',
                'div_circuito.id_distrito',
                'div_circuito.codigoSemplades',
                'div_distrito.composicion',
                'div_distrito.denominacion as distrito',
                'div_zona.denominacion as zona'
            );
    }



}