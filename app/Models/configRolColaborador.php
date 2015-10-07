<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class configRolColaborador extends Model {

    protected $table = 'config_rol_funcionario';
    protected $primaryKey = 'id_rol_funcionario';
    public $timestamps = false;


    //dependencias
    public function rol()
    {
        return $this->belongsTo('App\Models\configRol', 'id_rol');
    }

    public function funcionario()
    {
        return $this->belongsTo('App\Models\rrhhFuncionario', 'id_funcionario');
    }


}
