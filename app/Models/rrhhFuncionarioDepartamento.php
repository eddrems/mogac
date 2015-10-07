<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class rrhhFuncionarioDepartamento extends Model {

    protected $table = 'rrhh_funcionario_departamento';
    protected $primaryKey = 'id_funcionario_departamento';
    public $timestamps = false;




    public function funcionario()
    {
        return $this->belongsTo('App\Models\rrhhFuncionario', 'id_funcionario');
    }
    public function departamento()
    {
        return $this->belongsTo('App\Models\rrhhDepartamento', 'id_departamento');
    }










}





