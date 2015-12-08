<?php namespace App\Repositories\CriteriosConsulta\Usuarios;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class DepartamentosPorTipoUsuario extends Criteria {

    public $id_tipo_funcionario;

    public function __construct($id_tipo_funcionario) {

        $this->id_tipo_funcionario = $id_tipo_funcionario;
    }

    public function apply($model, Repository $repository)
    {
        switch($this->id_tipo_funcionario)
        {
            case 1:
                $query = $model->where('aplicable_distrito', 1);
                break;
            case 2:
                $query = $model->where('aplicable_zonal', 1);
                break;
            case 3:
                $query = $model->where('aplicable_nacional', 1);
                break;
        }

        $query = $model->orderBy('denominacion');
        return $query;
    }

}