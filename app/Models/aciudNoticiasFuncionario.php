<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class aciudNoticiasFuncionario extends Model {

    protected $table = 'aciud_noticia_funcionario';
    protected $primaryKey = 'id_noticia_funcionario';
    public $timestamps = false;


    //dependencias
    public function noticia()
    {
        return $this->belongsTo('App\Models\aciudNoticias', 'id_noticia');
    }

    public function funcionario()
    {
        return $this->belongsTo('App\Models\rrhhFuncionario', 'id_funcionario' );
    }

}
