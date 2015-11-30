<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class configRolModulo extends Model {

    protected $table = 'config_rol_modulo';
    protected $primaryKey = 'id_rol_modulo';
    protected $fillable = ['id_rol', 'id_modulo'];
    public $timestamps = false;


    //dependencias
    public function rol()
    {
        return $this->belongsTo('App\Models\configRol', 'id_rol');
    }
    public function modulo()
    {
        return $this->belongsTo('App\Models\configModulo', 'id_modulo');
    }


}
