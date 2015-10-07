<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class aciudTramiteResultado extends Model {

    protected $table = 'aciud_tramite_resultado';
    protected $primaryKey = 'id_tramite_resultado';
    public $timestamps = false;


    //dependencias
    public function tramite()
    {
        return $this->belongsTo('App\Models\aciudTramite', 'id_tramite_resultado');
    }



}





