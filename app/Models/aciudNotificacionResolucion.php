<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class aciudNotificacionResolucion extends Model {

    protected $table = 'aciud_notificacion_resolucion';
    protected $primaryKey = 'id_notificacion_resolucion';
    public $timestamps = false;


    //dependencias
    public function tramite()
    {
        return $this->belongsTo('App\Models\aciudTramite', 'id_tramite', 'id_tramite');
    }

    public function funcionario()
    {
        return $this->belongsTo('App\Models\rrhhFuncionario', 'id_funcionario' );
    }
    public function resultado()
    {
        return $this->belongsTo('App\Models\aciudTramiteResultado', 'id_tramite_resultado');
    }


}





