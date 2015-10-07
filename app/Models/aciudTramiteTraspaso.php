<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class aciudTramiteTraspaso extends Model {

    protected $table = 'aciud_tramite_traspaso';
    protected $primaryKey = 'id_tramite_traspaso';
    public $timestamps = false;


    //dependencias
    public function tramite()
    {
        return $this->belongsTo('App\Models\aciudTramite', 'id_tramite');
    }

    public function funcionario_emisor()
    {
        return $this->belongsTo('App\Models\rrhhFuncionario', 'id_funcionario_emisor', 'id_funcionario');
    }

    public function funcionario_receptor()
    {
        return $this->belongsTo('App\Models\rrhhFuncionario', 'id_funcionario_receptor', 'id_funcionario' );
    }

    public function distrito_origen()
    {
        return $this->belongsTo('App\Models\divDistrito', 'id_distrito_origen', 'id_distrito');
    }

    public function distrito_destino()
    {
        return $this->belongsTo('App\Models\divDistrito', 'id_distrito_destino', 'id_distrito');
    }



}





