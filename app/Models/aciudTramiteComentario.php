<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class aciudTramiteComentario extends Model {

    protected $table = 'aciud_tramite_comentario';
    protected $primaryKey = 'id_tramite_comentario';
    public $timestamps = false;


    //dependencias
    public function tramite()
    {
        return $this->belongsTo('App\Models\aciudTramite', 'id_tramite', 'id_tramite');
    }

    public function funcionario()
    {
        return $this->belongsTo('App\Models\rrhhFuncionario', 'id_funcionario' );
    }

    public function funcionarios_referenciados()
    {
        return $this->hasMany('App\Models\aciudTramiteComentarioFuncionario', 'id_tramite_comentario');
    }


}





