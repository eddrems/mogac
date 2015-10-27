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

}