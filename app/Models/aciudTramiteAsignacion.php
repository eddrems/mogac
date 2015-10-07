<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class aciudTramiteAsignacion extends Model {

    protected $table = 'aciud_tramite_asignacion';
    protected $primaryKey = 'id_tramite_asignacion';
    public $timestamps = false;



    function calcularDiasEnGestion()
    {
        if($this->attributes['dias_gestion'] == null)
        {
            $date_aux = new libdateCalc();
            $fecha_inicio_gestion =  date('Y-m-d', strtotime($this->attributes['fecha_confirmacion'] . ' + 1 day'));
            $dias_transcurridos = $date_aux->getWorkingDays($fecha_inicio_gestion,date("Y-m-d"), array());

            return $dias_transcurridos;
        }else
        {
            return $this->attributes['dias_gestion'];
        }
    }

    function calcularDiasEspera()
    {
        if($this->attributes['dias_espera_confirmacion'] == null)
        {
            $date_aux = new libdateCalc();
            $fecha_inicio_gestion =  date('Y-m-d', strtotime($this->attributes['fecha_entrega'] . ' + 1 day'));
            $dias_transcurridos = $date_aux->getWorkingDays($fecha_inicio_gestion,date("Y-m-d"), array());

            return $dias_transcurridos;
        }else
        {
            return $this->attributes['dias_espera_confirmacion'];
        }
    }

    //dependencias
    public function tramite()
    {
        return $this->belongsTo('App\Models\aciudTramite', 'id_tramite');
    }

    public function funcionario_emisor()
    {
        return $this->belongsTo('App\Models\rrhhFuncionario', 'id_funcionario_emisor', 'id_funcionario');
    }

    public function funcionario_receptor()
    {
        return $this->belongsTo('App\Models\rrhhFuncionario', 'id_funcionario_receptor', 'id_funcionario' );
    }



}





