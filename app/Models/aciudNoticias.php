<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class aciudNoticias extends Model {

    protected $table = 'aciud_noticias';
    protected $primaryKey = 'id_noticia';
    public $timestamps = false;


    //dependencias

    public function funcionario_ingreso()
    {
        return $this->belongsTo('App\Models\rrhhFuncionario', 'id_funcionario_ingreso', 'id_funcionario' );
    }

    public function distrito()
    {
        return $this->belongsTo('App\Models\divDistrito', 'id_distrito');
    }

    public function funcionarios_referenciados()
    {
        return $this->hasMany('App\Models\aciudNoticiasFuncionario', 'id_noticia');
    }

    public function logs()
    {
        return $this->hasMany('App\Models\aciudNoticiasLog', 'id_noticia');
    }



}





