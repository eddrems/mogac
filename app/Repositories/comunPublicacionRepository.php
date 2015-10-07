<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;


class comunPublicacionRepository extends  Repository  {




    function model()
    {
        return 'App\Models\comunPublicacion';
    }


}