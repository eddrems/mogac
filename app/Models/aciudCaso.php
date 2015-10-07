<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class aciudCaso extends Model {

    protected $table = 'aciud_cat_caso';
    protected $primaryKey = 'id_caso';
    protected $fillable = ['id_servicio', 'denominacion'];
    public $timestamps = false;



    public function getservicioAttribute()
    {
        return aciudServicio::find($this->attributes['id_servicio'])->denominacion;
    }

    public function servicio()
    {
        return $this->belongsTo('App\Models\aciudServicio', 'id_servicio');
    }


    public function procesos()
    {
        return $this->hasMany('App\Models\aciudProceso', 'id_caso');
    }


}

