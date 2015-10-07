<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class turnTurnoVisita extends Model {

    protected $table = 'turn_turno_visita';
    protected $primaryKey = 'id_turno';
    public $timestamps = false;


    //dependencias
    public function tipo()
    {
        return $this->belongsTo('App\Models\turnTipoTurno', 'id_tipo_turno');
    }

    public function estado()
    {
        return $this->belongsTo('App\Models\turnEstadoTurno', 'id_estado_turno');
    }

    public function proceso()
    {
        return $this->belongsTo('App\Models\aciudProceso', 'id_proceso');
    }

    public function funcionario_ingreso()
    {
        return $this->belongsTo('App\Models\rrhhFuncionario', 'id_funcionario_ingreso', 'id_funcionario' );
    }

    public function funcionario_consultado()
    {
        return $this->belongsTo('App\Models\rrhhFuncionariopcentral', 'id_funcionario_pcentral', 'id_funcionario_pcentral'  );
    }

    public function usuario()
    {
        return $this->belongsTo('App\Models\aciudUsuario', 'id_usuario', 'id_usuario' );
    }

   // public function modulo_atendido()
   // {
   //     return $this->belongsTo('aciudModuloAtencion', 'id_modulo_atencion' );
   // }

}





