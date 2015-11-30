<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;


class divInstitucionEducativaRepository extends  Repository  {




    function model()
    {
        return 'App\Models\divInstitucionEducativa';
    }

    public function buscar_todos_dt()
    {
        return \DB::table('div_institucion_educativa')
            ->join('div_parroquia', 'div_institucion_educativa.id_parroquia', '=', 'div_parroquia.id_parroquia')
            ->join('div_ciudad', 'div_parroquia.id_ciudad', '=', 'div_ciudad.id_ciudad')
            ->join('div_circuito', 'div_institucion_educativa.id_circuito', '=', 'div_circuito.id_circuito')
            ->join('div_distrito', 'div_circuito.id_distrito', '=', 'div_distrito.id_distrito')
            ->join('div_zona', 'div_distrito.id_zona', '=', 'div_zona.id_zona')
            ->select(
                'div_institucion_educativa.id_institucion_educativa',
                'div_institucion_educativa.codigo_amie',
                'div_institucion_educativa.denominacion',
                \DB::raw('CONCAT(div_parroquia.denominacion, " (", div_ciudad.denominacion,")") AS ubicacion'),
                \DB::raw('CONCAT(div_circuito.codigoSemplades, " - ", div_distrito.denominacion, " - ", div_zona.denominacion) AS ubicacion2')
            );
    }
}