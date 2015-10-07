<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class rrhhCargo extends Model {


    protected $table = 'rrhh_cargo';
    protected $primaryKey = 'id_cargo';
    public $timestamps = false;


    public function funcionarios()
    {
        return $this->hasMany('App\Models\rrhhFuncionario', 'id_cargo');
    }


}
