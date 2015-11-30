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
                'div_circuito.composicion',
                'div_distrito.denominacion as distrito',
                'div_zona.denominacion as zona'
            );
    }

    public function generar_lista_con_agrupador_distritos($valor = null)
    {

        \Form::macro('selectOpt', function(\ArrayAccess $collection, $name, $groupBy, $labelBy = 'name', $valueBy = 'id', $value = null, $attributes = array()) {
            $select_optgroup_arr = [];
            foreach ($collection as $item)
            {
                $select_optgroup_arr[$item->$groupBy][$item->$valueBy] = $item->$labelBy;
            }
            return \Form::select($name, $select_optgroup_arr, $value, $attributes);
        });

        return \Form::selectOpt($this->model->orderBy('codigoSemplades')->get(), 'id_circuito', 'distrito', 'codigoSemplades', 'id_circuito', $valor, array('class' => 'form-control', 'data-required' => 'true', 'id' => 'id_circuito'));
    }

}