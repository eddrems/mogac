<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class aciudTramiteLog extends Model {

    protected $table = 'aciud_tramite_log';
    protected $primaryKey = 'id_tramite_log';
    public $timestamps = false;


    //dependencias
    public function tramite()
    {
        return $this->belongsTo('App\Models\aciudTramite', 'id_tramite', 'id_tramite');
    }

    public function departamento()
    {
        return $this->belongsTo('App\Models\rrhhDepartamento', 'id_departamento', 'id_departamento');
    }

    public function departamento_anterior()
    {
        return $this->belongsTo('App\Models\rrhhDepartamento', 'id_departamento_anterior', 'id_departamento');
    }

    public function proceso()
    {
        return $this->belongsTo('App\Models\aciudProceso', 'id_proceso');
    }

    public function proceso_anterior()
    {
        return $this->belongsTo('App\Models\aciudProceso', 'id_proceso_anterior', 'id_proceso');
    }

    public function funcionario()
    {
        return $this->belongsTo('App\Models\rrhhFuncionario', 'id_funcionario' );
    }

    
}





