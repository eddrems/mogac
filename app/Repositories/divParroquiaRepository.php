<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;


class divParroquiaRepository extends  Repository  {




    function model()
    {
        return 'App\Models\divParroquia';
    }



    public function bucar_parroquias_ruta_completa()
    {
        return \DB::table('div_parroquia')
            ->join('div_ciudad', 'div_parroquia.id_ciudad', '=', 'div_ciudad.id_ciudad')
            ->join('div_provincia', 'div_ciudad.id_provincia', '=', 'div_provincia.id_provincia')
            ->orderBy('div_ciudad.denominacion')
            ->orderBy('div_parroquia.denominacion')
            ->select(\DB::raw('CONCAT(div_parroquia.denominacion, " ( ", div_ciudad.denominacion, " | ", div_provincia.denominacion, " )") AS ruta'), 'id_parroquia')
            ->lists('ruta', 'id_parroquia');
    }

}