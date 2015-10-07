<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class divZona extends Model {


    protected $table = 'div_zona';
    protected $primaryKey = 'id_zona';
    protected $fillable = ['codigoSemplades','denominacion','denominacion_institucional','composicion','logo_certificacion','numero_certificacion','pie_pagina_certificacion','logo_top','logo_left','numero_top','numero_width','logo_scale'];
    public $timestamps = false;



    public function funcionarios()
    {
        return $this->hasMany('App\Models\rrhhFuncionario', 'id_zona');
    }
    public function distritos()
    {
        return $this->hasMany('App\Models\divDistrito', 'id_zona');
    }
}



