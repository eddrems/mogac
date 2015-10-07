<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class divEstadoInstitucionEducativa extends Model {


    protected $table = 'div_estado_institucion_educativa';
    protected $primaryKey = 'id_estado_institucion_educativa';
    public $timestamps = false;


    public function tramites()
    {
        return $this->hasMany('App\Models\divInstitucionEducativa', 'id_estado_institucion_educativa');
    }

}



