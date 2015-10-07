<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class aciudTramiteComentarioFuncionario extends Model {

    protected $table = 'aciud_tramite_comentario_funcionario';
    protected $primaryKey = 'id_tramite_comentario_funcionario';
    public $timestamps = false;


    //dependencias
    public function comentario()
    {
        return $this->belongsTo('App\Models\aciudTramiteComentario', 'id_tramite_comentario');
    }

    public function funcionario()
    {
        return $this->belongsTo('App\Models\rrhhFuncionario', 'id_funcionario' );
    }

}





