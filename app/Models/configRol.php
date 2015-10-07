<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class configRol extends Model {

    protected $table = 'config_rol';
    protected $primaryKey = 'id_rol';
    public $timestamps = false;


    public function modulos_asignados()
    {
        return $this->hasMany('App\Models\configRolModulo', 'id_rol');
    }
    
    public function modulo_predefinido()
    {
        return $this->belongsTo('App\Models\configModulo', 'id_subsistema', 'predefinido_modulo_id');
    }    
    
    public function colaboradores_asignados()
    {
        return $this->hasMany('App\Models\configRolColaborador', 'id_rol');
    }


}
