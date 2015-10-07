<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class configModulo extends Model {

    protected $table = 'config_modulo';
    protected $primaryKey = 'id_modulo';
    public $timestamps = false;


    //dependencias
    public function subsistema()
    {
        return $this->belongsTo('App\Models\configModuloSubsistema', 'id_subsistema');
    }

    public function roles_asignados()
    {
        return $this->hasMany('App\Models\configRolModulo', 'id_modulo');
    }


}





