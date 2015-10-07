<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class configLogSesion extends Model {

    protected $table = 'config_log_sesion';
    protected $primaryKey = 'id_log_sesiones';
    protected $fillable = ['id_funcionario', 'fecha', 'hora', 'ip'];
    public $timestamps = false;


    //dependencias
    public function funcionario()
    {
        return $this->belongsTo('App\Models\rrhhFuncionario', 'id_funcionario');
    }


}
