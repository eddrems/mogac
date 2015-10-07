<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class divCircuito extends Model {


    protected $table = 'div_circuito';
    protected $primaryKey = 'id_circuito';
    public $timestamps = false;


    public function tramites()
    {
        return $this->hasMany('App\Models\divInstitucionEducativa', 'id_circuito');
    }
    public function distrito()
    {
        return $this->belongsTo('App\Models\divDistrito', 'id_distrito');
    }

    public function getCircuitoFullNameAttribute()
    {
        return $this->attributes['App\Models\codigoSemplades'].' / '.$this->attributes['composicion'];
    }


}



