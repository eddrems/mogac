<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;


class aciudNoticiasRepository extends  Repository  {




    function model()
    {
        return 'App\Models\aciudNoticias';
    }


}