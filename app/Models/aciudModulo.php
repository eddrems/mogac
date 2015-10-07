<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class aciudModulo extends Model {

    protected $table = 'aciud_modulo';
    protected $primaryKey = 'id_modulo';
    public $timestamps = false;




    public function distrito()
    {
        return $this->belongsTo('App\Models\divDistrito', 'id_distrito');
    }


    public function modulo_asignado()
    {
        return $this->hasMany('App\Models\aciudModuloAtencion', 'id_modulo');
    }


    public function tipo_predefinido()
    {
        return $this->belongsTo('App\Models\turnTipoTurno', 'tipo_atencion');
    }


}

