<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class comunPublicacion extends Model {

    protected $table = 'comun_publicacion';
    protected $primaryKey = 'id_publicacion';
    public $timestamps = false;


    //dependencias

    public function funcionario_ingreso()
    {
        return $this->belongsTo('App\Models\vrrhhFuncionario', 'id_funcionario_ingreso', 'id_funcionario' );
    }

    public function distrito()
    {
        return $this->belongsTo('App\Models\divDistrito', 'id_distrito');
    }


    public function departamento()
    {
        return $this->belongsTo('App\Models\rrhhDepartamento', 'id_departamento');
    }
    /*
    public function funcionarios_referenciados()
    {
        return $this->hasMany('aciudNoticiasFuncionario', 'id_publicacion');
    }

    public function logs()
    {
        return $this->hasMany('aciudNoticiasLog', 'id_publicacion');
    }
*/


}





