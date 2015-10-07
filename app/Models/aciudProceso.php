<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class aciudProceso extends Model {

    protected $table = 'aciud_proceso';
    protected $primaryKey = 'id_proceso';
    protected $fillable = ['id_departamento','id_caso','denominacion','base_legal','proposito','tiempo','requiere_caso_snap','incluir_matriz_snap','activo_recepcion','codigo_min_educ'];
    public $timestamps = false;


    public function getdepartamentoAttribute()
    {
        return rrhhDepartamento::find($this->attributes['id_departamento'])->denominacion;
    }



    //dependencias
    public function departamento()
    {
        return $this->belongsTo('App\Models\rrhhDepartamento', 'id_departamento');
    }

    public function caso()
    {
        return $this->belongsTo('App\Models\aciudCaso', 'id_caso');
    }

    //tiene
    public function requisitos()
    {
        return $this->hasMany('App\Models\aciudProcesoRequisitos', 'id_proceso');
    }

    public function turnos()
    {
        return $this->hasMany('App\Models\turnTurno', 'id_proceso');
    }

    public function tramites_ciudadanos()
    {
        return $this->hasMany('App\Models\aciudTramiteCiudadano', 'id_proceso');
    }

}

