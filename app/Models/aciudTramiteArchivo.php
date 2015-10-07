<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class aciudTramiteArchivo extends Model {

    protected $table = 'aciud_tramite_archivo';
    protected $primaryKey = 'id_tramite_archivo';
    public $timestamps = false;


    public function tramite()
    {
        return $this->belongsTo('App\Models\aciudTramite', 'id_tramite');
    }

    public function funcionario()
    {
        return $this->belongsTo('App\Models\rrhhFuncionario', 'id_funcionario' );
    }



}





