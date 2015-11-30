<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class divCiudad extends Model {


    protected $table = 'div_ciudad';
    protected $primaryKey = 'id_ciudad';
    protected $fillable = ['id_ciudad', 'id_provincia','denominacion','codigo'];
    public $timestamps = false;


    public function getnombreprovinciaAttribute()
    {
        return divProvincia::find($this->attributes['id_provincia'])->denominacion;
    }



    public function parroquias()
    {
        return $this->hasMany('App\Models\divParroquia', 'id_ciudad');
    }

    public function provincia()
    {
        return $this->belongsTo('App\Models\divProvincia', 'id_provincia');
    }


}



