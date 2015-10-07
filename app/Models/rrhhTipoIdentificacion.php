<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class rrhhTipoIdentificacion extends Model {

    protected $table = 'rrhh_tipo_identificacion';
    protected $primaryKey = 'id_tipo_identificacion';
    public $timestamps = false;


    public function funcionarios()
    {
        return $this->hasMany('App\Models\rrhhFuncionario', 'id_tipo_identificacion');
    }

}
