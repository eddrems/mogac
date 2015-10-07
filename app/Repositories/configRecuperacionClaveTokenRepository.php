<?php namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;


class configRecuperacionClaveTokenRepository extends  Repository  {




    function model()
    {
        return 'App\Models\configRecuperacionClaveToken';
    }


}