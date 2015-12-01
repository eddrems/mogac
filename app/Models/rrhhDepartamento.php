<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class rrhhDepartamento extends Model {


    protected $table = 'rrhh_departamento';
    protected $primaryKey = 'id_departamento';
    protected  $fillable = ['denominacion', 'esta_vigente', 'aplicable_nacional', 'aplicable_zonal', 'aplicable_distrito', 'bloqueado', 'permite_asignacion_multiple'];
    public $timestamps = false;


    public function funcionarios()
    {
        return $this->hasMany('App\Models\rrhhFuncionario', 'id_departamento');
    }





}



