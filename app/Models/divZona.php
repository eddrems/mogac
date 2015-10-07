<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class divZona extends Model {


    protected $table = 'div_zona';
    protected $primaryKey = 'id_zona';
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



