<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class divInstitucionEducativa extends Model {


    protected $table = 'div_institucion_educativa';
    protected $primaryKey = 'id_institucion_educativa';
    public $timestamps = false;


    public function getDenominacionConCiudadAttribute()
    {
        return $this->attributes['nombres'].'  ( ---o--- ';
    }


    //dependencias
    public function estado()
    {
        return $this->belongsTo('App\Models\divEstadoInstitucionEducativa', 'id_estado_institucion_educativa');
    }

    public function circuito()
    {
        return $this->belongsTo('App\Models\divCircuito', 'id_circuito');
    }

    public function parroquia()
    {
        return $this->belongsTo('App\Models\divParroquia', 'id_parroquia');
    }

    public function usuarios()
    {
        return $this->hasMany('App\Models\aciudUsuario', 'id_institucion_educativa');
    }

    public function idprincipal()
    {
        return $this->belongsTo('App\Models\divInstitucionEducativa', 'id_institucion_educativa_pertenece', 'id_institucion_educativa');
    }
}




