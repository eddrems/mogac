<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class aciudEstadoTramite extends Model {


    protected $table = 'aciud_estado_tramite';
    protected $primaryKey = 'id_estado_tramite';
    protected $fillable = ['orden','denominacion','css_color', 'css_label_class', 'letra', 'permite_edicion', 'proceso_terminado', 'permite_cambio_manual', 'permite_traslado_distrito'];
    public $timestamps = false;


    public function tramites()
    {
        return $this->hasMany('App\Models\aciudTramite', 'id_estado_tramite');
    }

}



