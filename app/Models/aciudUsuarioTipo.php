<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class aciudUsuarioTipo extends Model {

    protected $table = 'aciud_usuario_tipo';
    protected $primaryKey = 'id_ciudadano_tipo';
    public $timestamps = false;


    public function usuarios()
    {
        return $this->hasMany('App\Models\aciudUsuario', 'id_ciudadano_tipo');
    }

}
