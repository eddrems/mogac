<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class aciudModuloAtencion extends Model {

    protected $table = 'aciud_modulo_atencion';
    protected $primaryKey = 'id_modulo_atencion';
    public $timestamps = false;






    //dependencias
    public function funcionario()
    {
        return $this->belongsTo('App\Models\rrhhFuncionario', 'id_funcionario');
    }

    public function modulo()
    {
        return $this->belongsTo('App\Models\aciudModulo', 'id_modulo');
    }

    public function turTipo()
    {
        return $this->belongsTo('App\Models\turnTipoTurno', 'tipo_atencion');
    }


}

