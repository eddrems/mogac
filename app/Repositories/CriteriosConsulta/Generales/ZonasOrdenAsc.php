<?php namespace App\Repositories\CriteriosConsulta\Generales;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class ZonasOrdenAsc extends Criteria {

    public function apply($model, Repository $repository)
    {
        $query = $model->orderBy('codigoSemplades');
        return $query;

    }

}