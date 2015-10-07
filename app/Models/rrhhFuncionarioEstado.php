<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class rrhhFuncionarioEstado extends Model {


    protected $table = 'rrhh_funcionario_estado';
    protected $primaryKey = 'id_funcionario_estado';
    public $timestamps = false;


    public function funcionarios()
    {
        return $this->hasMany('App\Models\rrhhFuncionario', 'id_funcionario_estado');
    }

}



