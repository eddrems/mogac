<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class configModuloSubsistema extends Model {


    protected $table = 'config_modulosubsistema';
    protected $primaryKey = 'id_subsistema';
    public $timestamps = false;


    public function modulos()
    {
        return $this->hasMany('App\Models\configModulo', 'id_subsistema');
    }

}

