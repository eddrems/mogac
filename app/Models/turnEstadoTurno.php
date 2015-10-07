<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class turnEstadoTurno extends Model {


    protected $table = 'turn_estado_turno';
    protected $primaryKey = 'id_estado_turno';
    public $timestamps = false;


    public function turnos()
    {
        return $this->hasMany('App\Models\turnTurno', 'id_estado_turno');
    }

}



