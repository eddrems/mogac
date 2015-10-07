<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class turnTipoTurno extends Model {


    protected $table = 'turn_tipo_turno';
    protected $primaryKey = 'id_tipo_turno';
    public $timestamps = false;


    public function funcionarios()
    {
        return $this->hasMany('App\Models\turnTurno', 'id_tipo_turno');
    }

    public function tipo()
    {
        return $this->belongsTo('App\Models\aciudModulo', 'tipo_atencion');
    }

    public function modulo()
    {
        return $this->belongsTo('App\Models\aciudModulo', 'id_modulo');
    }

}



