<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class aciudProcesoRequisitos extends Model {

    protected $table = 'aciud_proceso_requisitos';
    protected $primaryKey = 'id_requisitos';
    protected $fillable = ['id_proceso', 'nombre', 'observaciones'];
    public $timestamps = false;

    //dependencias
    public function subcategoria_tramite()
    {
        return $this->belongsTo('App\Models\aciudProceso', 'id_proceso');
    }

}

