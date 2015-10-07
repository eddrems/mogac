<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class rrhhTipoFuncionario extends Model {

    protected $table = 'rrhh_tipo_funcionario';
    protected $primaryKey = 'id_tipo_funcionario';
    public $timestamps = false;


    public function funcionarios()
    {
        return $this->hasMany('App\Models\rrhhFuncionario', 'id_tipo_funcionario');
    }

}
