<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;


class configRolModuloRepository extends  Repository  {




    function model()
    {
        return 'App\Models\configRolModulo';
    }


    public function buscar_todos_dt($id_rol)
    {
        return \DB::table('config_rol_modulo')
            ->join('config_modulo', 'config_rol_modulo.id_modulo', '=', 'config_modulo.id_modulo')
            ->join('config_modulosubsistema', 'config_modulo.id_subsistema', '=', 'config_modulosubsistema.id_subsistema')
            ->where('config_rol_modulo.id_rol', $id_rol)
            ->orderBy('config_modulo.descripcion')
            ->select(
                'config_rol_modulo.id_rol_modulo',
                'config_modulo.descripcion as modulo',
                'config_modulosubsistema.descripcion as agrupador'
            );
    }

}