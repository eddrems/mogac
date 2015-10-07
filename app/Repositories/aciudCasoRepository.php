<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;


class aciudCasoRepository extends  Repository  {




    function model()
    {
        return 'App\Models\aciudCaso';
    }


    public function buscar_todos_dt()
    {
        return \DB::table('aciud_cat_caso')
            ->join('aciud_cat_servicio', 'aciud_cat_caso.id_servicio', '=', 'aciud_cat_servicio.id_servicio')
            ->select(
                'aciud_cat_servicio.denominacion as servicio',
                'aciud_cat_caso.id_caso',
                'aciud_cat_caso.denominacion'
            );
    }



    public function generar_lista_con_servicio()
    {
        \Form::macro('selectOpt', function(\ArrayAccess $collection, $name, $groupBy, $labelBy = 'name', $valueBy = 'id', $value = null, $attributes = array()) {
            $select_optgroup_arr = [];
            foreach ($collection as $item)
            {
                $select_optgroup_arr[$item->$groupBy][$item->$valueBy] = $item->$labelBy;
            }
            return \Form::select($name, $select_optgroup_arr, $value, $attributes);
        });


        return \Form::selectOpt($this->model->all(), 'id_caso', 'servicio', 'denominacion', 'id_caso', null, array('class' => 'form-control', 'data-required' => 'true', 'id' => 'id_caso'));

    }


    public function generar_lista_con_servicio_seleccion($valor)
    {
        \Form::macro('selectOpt', function(\ArrayAccess $collection, $name, $groupBy, $labelBy = 'name', $valueBy = 'id', $value = null, $attributes = array()) {
            $select_optgroup_arr = [];
            foreach ($collection as $item)
            {
                $select_optgroup_arr[$item->$groupBy][$item->$valueBy] = $item->$labelBy;
            }
            return \Form::select($name, $select_optgroup_arr, $value, $attributes);
        });


        return \Form::selectOpt($this->model->all(), 'id_caso', 'servicio', 'denominacion', 'id_caso', $valor, array('class' => 'form-control', 'data-required' => 'true', 'id' => 'id_caso'));

    }


}