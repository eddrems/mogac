<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class configRol extends Model {

    protected $table = 'config_rol';
    protected $primaryKey = 'id_rol';
    protected $fillable = ['denominacion', 'denominacion_visual', 'predefinido_modulo_id', 'esta_vigente', 'nivel_nacional', 'nivel_zonal', 'nivel_distrital'];
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
