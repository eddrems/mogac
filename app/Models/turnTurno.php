<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class turnTurno extends Model {

    protected $table = 'turn_turno';
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
        return $this->belongsTo('App\Models\rrhhFuncionario', 'id_funcionario_buscado', 'id_funcionario' );
    }
    
    public function usuario()
    {
        return $this->belongsTo('App\Models\aciudUsuario', 'id_persona', 'id_usuario' );
    }

    public function modulo_atendido()
    {
        return $this->belongsTo('App\Models\aciudModuloAtencion', 'id_modulo_atencion' );
    }

// *********************************** CONSULTA RESUMEN TURNOS DEL DÍA ***********************************************

    public function resumenTurnos()
    {
        if (!Cache::has('global_tipos_turnos')) { Cache::put('global_tipos_turnos', turnTipoTurno::orderBy('orden_presentacion')->get(), 240); }
        $tipos_turnos = Cache::get('global_tipos_turnos');

        $estado_html = '';
        $fecha = date("Y-m-d");
        foreach($tipos_turnos as $tipo)
        {
            $entregados = turnTurno::where('ingreso_fecha','=', $fecha)->where('id_tipo_turno','=', $tipo->id_tipo_turno)->where('id_distrito','=', Auth::user()->id_distrito)->count();
            $fila = turnTurno::where('ingreso_fecha','=', $fecha)->where('id_tipo_turno','=', $tipo->id_tipo_turno)
                ->where('id_tipo_turno','=', $tipo->id_tipo_turno)
                ->where('id_distrito','=', Auth::user()->id_distrito)
                ->where(function($query)
                {
                    $query->where('id_estado_turno', '=', 'I')
                        ->orWhere('id_estado_turno', '=', 'L');
                })
                ->count();
            $ventanilla = turnTurno::where('ingreso_fecha','=', date("Y-m-d"))->where('id_tipo_turno','=', $tipo->id_tipo_turno)
                ->where('id_tipo_turno','=', $tipo->id_tipo_turno)
                ->where('id_distrito','=', Auth::user()->id_distrito)
                ->where('id_estado_turno', '=', 'V')
                ->count();
            $atendido = turnTurno::where('ingreso_fecha','=', date("Y-m-d"))->where('id_tipo_turno','=', $tipo->id_tipo_turno)
                ->where('id_tipo_turno','=', $tipo->id_tipo_turno)
                ->where('id_distrito','=', Auth::user()->id_distrito)
                ->where('id_estado_turno', '=', 'C')
                ->count();
            $revocado = turnTurno::where('ingreso_fecha','=', date("Y-m-d"))->where('id_tipo_turno','=', $tipo->id_tipo_turno)
                ->where('id_tipo_turno','=', $tipo->id_tipo_turno)
                ->where('id_distrito','=', Auth::user()->id_distrito)
                ->where('id_estado_turno', '=', 'D')
                ->count();
            $estado_html = $estado_html . '<li class="m-b-xxs"><div class="r bg-white b-l b-4x b-'. $tipo->css_label_class .' wrapper-xs ui-draggable" style="position: relative;"> <spna style="font-size:9pt;" >'
                . $tipo->denominacion
                . ' </spna><br>'
                . '&nbsp;&nbsp;<i class="fa fa-tags"></i> ' . $entregados
                . '&nbsp;&nbsp;<i class="fa fa-users"></i> ' . $fila
                . '&nbsp;&nbsp;<i class="fa fa-desktop"></i> ' . $ventanilla
                . '&nbsp;&nbsp;<i class="fa fa-thumbs-up"></i> ' . $atendido
                . '&nbsp;&nbsp;<i class="fa fa-trash-o"></i> ' . $revocado
                . '</div></li>';
        }
        return Response::json(array(
            'datos' => $estado_html
        ));
    }
    
}





