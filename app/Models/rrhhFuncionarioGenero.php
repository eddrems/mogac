<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class rrhhFuncionarioGenero extends Model {


    protected $table = 'rrhh_genero';
    protected $primaryKey = 'id_genero';
    public $timestamps = false;


    public function funcionarios()
    {
        return $this->hasMany('App\Models\rrhhFuncionario', 'id_genero');
    }

}



