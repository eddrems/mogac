<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class configLogAcceso extends Model {

    protected $table = 'config_log_acceso';
    protected $primaryKey = 'id_log_acceso';
    public $timestamps = false;


    //dependencias
    public function funcionario()
    {
        return $this->belongsTo('App\Models\rrhhFuncionario', 'id_funcionario');
    }
    public function modulo()
    {
        return $this->belongsTo('App\Models\configModulo', 'id_modulo');
    }

}
