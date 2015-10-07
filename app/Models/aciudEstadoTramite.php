<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class aciudEstadoTramite extends Model {


    protected $table = 'aciud_estado_tramite';
    protected $primaryKey = 'id_estado_tramite';
    public $timestamps = false;


    public function tramites()
    {
        return $this->hasMany('App\Models\aciudTramite', 'id_estado_tramite');
    }

}



