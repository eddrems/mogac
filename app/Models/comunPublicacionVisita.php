<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class comunPublicacionVisita extends Model {

    protected $table = 'comun_publicacion_visita';
    protected $primaryKey = 'id_publicacion_visita';
    public $timestamps = false;


    //dependencias

    public function funcionario()
    {
        return $this->belongsTo('App\Models\rrhhFuncionario', 'id_funcionario_ingreso', 'id_funcionario' );
    }

    public function publicacion()
    {
        return $this->belongsTo('App\Models\comunPublicacion', 'id_publicacion');
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





