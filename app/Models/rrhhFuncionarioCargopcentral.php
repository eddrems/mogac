<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class rrhhFuncionarioCargopcentral extends Model {

    protected $table = 'pcentral_cargo';
    protected $primaryKey = 'id_cargo_pcentral';
    public $timestamps = false;


    public function funcionarios()
    {
        return $this->hasMany('App\Models\rrhhFuncionariopcentral', 'id_cargo_pcentral');
    }

}
