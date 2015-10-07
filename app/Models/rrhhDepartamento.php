<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class rrhhDepartamento extends Model {


    protected $table = 'rrhh_departamento';
    protected $primaryKey = 'id_departamento';
    public $timestamps = false;


    public function funcionarios()
    {
        return $this->hasMany('App\Models\rrhhFuncionario', 'id_departamento');
    }





}



