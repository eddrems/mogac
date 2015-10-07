<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class rrhhEstadoCivil extends Model {


    protected $table = 'rrhh_estado_civil';
    protected $primaryKey = 'id_estado_civil';
    public $timestamps = false;


    public function funcionarios()
    {
        return $this->hasMany('App\Models\rrhhFuncionario', 'id_estado_civil');
    }

}



