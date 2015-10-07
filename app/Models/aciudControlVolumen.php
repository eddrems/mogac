<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class aciudControlVolumen extends Model {

    protected $table = 'tbl_temp_files';
    protected $primaryKey = 'id_files';
    public $timestamps = false;

   //dependencias

    public function volu()
    {
        return $this->belongsTo('App\Models\turnTurno', 'id_turno');
    }



}





