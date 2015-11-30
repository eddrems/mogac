<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class configModulo extends Model {

    protected $table = 'config_modulo';
    protected $primaryKey = 'id_modulo';
    protected $fillable = ['id_modulo', 'id_subsistema', 'orden', 'descripcion', 'texto', 'accion', 'controlador', 'icon'];
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


    public function getagrupadorAttribute()
    {

        $agrupador = configModuloSubsistema::find($this->attributes['id_subsistema']);

        return $agrupador->descripcion;
    }

}





