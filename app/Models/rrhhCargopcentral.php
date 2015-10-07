<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class rrhhcargopcentral extends Model {


    protected $table = 'pcentral_cargo';
    protected $primaryKey = 'id_cargo_pcentral';
    public $timestamps = false;


    public function funcionarios_pcentral()
    {
        return $this->hasMany('App\Models\pcentral_funcionario', 'id_cargo_pcentral');
    }


}
