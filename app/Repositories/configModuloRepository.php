<?php namespace App\Repositories;

use App\Models\configRolModulo;
use Bosnadev\Repositories\Eloquent\Repository;


class configModuloRepository extends  Repository  {




    function model()
    {
        return 'App\Models\configModulo';
    }


    public function buscar_todos_dt($id_subsistema)
    {
        return \DB::table('config_modulo')
            ->where('id_subsistema', $id_subsistema)
            ->select(
                'id_modulo',
                'id_subsistema',
                'orden',
                'descripcion',
                'texto',
                'accion',
                'controlador',
                'icon'
            );
    }

    public function generar_lista_con_agrupador_permisos($valor = null, $id_rol)
    {

        \Form::macro('selectOpt', function(\ArrayAccess $collection, $name, $groupBy, $labelBy = 'name', $valueBy = 'id', $value = null, $attributes = array()) {
            $select_optgroup_arr = [];
            foreach ($collection as $item)
            {
                $select_optgroup_arr[$item->$groupBy][$item->$valueBy] = $item->$labelBy;
            }
            return \Form::select($name, $select_optgroup_arr, $value, $attributes);
        });

        $modulos_asignados = configRolModulo::where('id_rol', $id_rol)->select('id_modulo')->get()->toArray();

        return \Form::selectOpt($this->model->whereNotIn('id_modulo', $modulos_asignados)->orderBy('descripcion')->get(), 'id_modulo', 'agrupador', 'descripcion', 'id_modulo', $valor, array('class' => 'form-control', 'data-required' => 'true', 'id' => 'id_modulo'));
    }



}