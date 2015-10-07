<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class aciudTramite extends Model {

    protected $table = 'aciud_tramite';
    protected $primaryKey = 'id_tramite';
    public $timestamps = false;


    //dependencias
    public function departamento()
    {
        return $this->belongsTo('App\Models\rrhhDepartamento', 'id_departamento');
    }

    public function proceso()
    {
        return $this->belongsTo('App\Models\aciudProceso', 'id_proceso');
    }

    public function caso()
    {
        return $this->belongsTo('App\Models\snapCaso', 'id_caso');
    }

    public function estado()
    {
        return $this->belongsTo('App\Models\aciudEstadoTramite', 'id_estado_tramite');
    }
    
    public function turno()
    {
        return $this->belongsTo('App\Models\turnTurno', 'id_turno');
    }
    
    public function usuario()
    {
        return $this->belongsTo('App\Models\aciudUsuario', 'id_usuario', 'id_usuario' );
    }    
    
    public function funcionario_ingreso()
    {
        return $this->belongsTo('App\Models\rrhhFuncionario', 'id_funcionario' );
    }

    public function distrito()
    {
        return $this->belongsTo('App\Models\divDistrito', 'id_distrito');
    }

    public function funcionario_posee()
    {
        return $this->belongsTo('App\Models\rrhhFuncionario', 'id_funcionario_ubicacion', 'id_funcionario');
    }

    public function departamento_posee()
    {
        return $this->belongsTo('App\Models\rrhhDepartamento', 'id_departamento_ubicacion', 'id_departamento');
    }



    public function distrito_ingreso()
    {
        return $this->belongsTo('App\Models\divDistrito', 'id_distrito_ingreso', 'id_distrito');
    }


    public function resultado()
    {
        return $this->belongsTo('App\Models\aciudTramiteResultado', 'id_tramite_resultado');
    }





    public function logs2()
    {
        return $this->hasMany('App\Models\aciudTramiteLog', 'id_tramite');
    }

    public function logs()
    {
        return $this->hasMany('App\Models\aciudTramiteLog', 'id_tramite');
    }



    public function documentos()
    {
        return $this->hasMany('App\Models\aciudTramiteArchivo', 'id_tramite');
    }


    
}





