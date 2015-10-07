<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class aciudCalificacionServicio extends Model {


    protected $table = 'aciud_calificacion_servicio';
    protected $primaryKey = 'id_calificacion_servicio';
    public $timestamps = false;


    public function turnos()
    {
        return $this->hasMany('App\Models\turnTurno', 'id_calificacion_servicio');
    }

}



