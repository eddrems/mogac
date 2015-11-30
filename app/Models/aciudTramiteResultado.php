<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class aciudTramiteResultado extends Model {

    protected $table = 'aciud_tramite_resultado';
    protected $primaryKey = 'id_tramite_resultado';
    protected $fillable = ['id_tramite_resultado', 'denominacion', 'requiere_observaciones'];
    public $timestamps = false;


    //dependencias
    public function tramites()
    {
        return $this->hasMany('App\Models\aciudTramite', 'id_tramite_resultado');
    }

    //





}






