<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use DB;
use Session;


class rrhhFuncionario extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    protected $table = 'rrhh_funcionario';
    protected $primaryKey = 'id_funcionario';
    public $timestamps = false;



    public function tipo()
    {
        return $this->belongsTo('App\Models\rrhhTipoFuncionario', 'id_tipo_funcionario');
    }

    public function estado()
    {
        return $this->belongsTo('App\Models\rrhhFuncionarioEstado', 'id_funcionario_estado');
    }
    public function genero()
    {
        return $this->belongsTo('App\Models\rrhhFuncionarioGenero', 'id_genero');
    }
    public function cargo()
    {
        return $this->belongsTo('App\Models\rrhhFuncionarioCargo', 'id_cargo');
    }
    public function estado_civil()
    {
        return $this->belongsTo('App\Models\rrhhEstadoCivil', 'id_estado_civil');
    }
    public function tipo_identificacion()
    {
        return $this->belongsTo('App\Models\rrhhTipoIdentificacion', 'id_tipo_identificacion');
    }
    public function departamento()
    {
        return $this->belongsTo('App\Models\rrhhDepartamento', 'id_departamento');
    }
    public function zona()
    {
        return $this->belongsTo('App\Models\divZona', 'id_zona');
    }
    public function distrito()
    {
        return $this->belongsTo('App\Models\divDistrito', 'id_distrito');
    }




    public function roles_asignados()
    {
        return $this->hasMany('App\Models\configRolColaborador', 'id_funcionario');
    }
    public function tramiteciudadanosubcategorias()
    {
        return $this->hasMany('App\Models\aciudTramiteCiudadanoSubcategoria', 'IDTramiteSubcategoria');
    }
    public function tramiteciudadanos()
    {
        return $this->hasMany('App\Models\aciudTramiteCiudadano', 'id_funcionario');
    }

    public function departamentos_asignados()
    {
        return $this->hasMany('App\Models\rrhhFuncionarioDepartamento', 'id_funcionario');
    }














    public function validar_acceso($IDModuloAutorizar)
    {

        if (!Session::has('spa'))
        {
            $modulos_arr = array();
            $existencia = configRolColaborador::where('id_funcionario', $this->id_funcionario)->get()->count();

            if($existencia > 0){
                $modulos_id = configRolModulo::whereIn('id_rol', function($query){
                    $query->select('id_rol')
                        ->from(with(new configRolColaborador)->getTable())
                        ->where('id_funcionario', $this->id_funcionario);
                })->select('id_modulo')->get()->toArray();

                $modulos = configModulo::whereIn('id_modulo', $modulos_id)->orderBy('orden')->get();
                foreach($modulos as $modulo)
                {
                    $modulos_arr[] = $modulo->id_modulo;
                }
            }

            Session::put('spa',$modulos_arr);
        }


        if(in_array($IDModuloAutorizar,  (array)Session::get('spa')))
            return 1;
        else
            return 0;



    }







//    public function getAuthIdentifier()
//    {
//        return $this->id_funcionario;
//    }
//    public function getAuthPassword()
//    {
//        return $this->clave_acceso;
//    }
//    public function getColaboradorFullNameAttribute()
//    {
//        return $this->attributes['apellidos'].' '.$this->attributes['nombres'];
//    }
//    public function getRememberToken()
//    {
//        return $this->remember_token;
//    }
//    public function getRememberTokenName()
//    {
//        return 'remember_token';
//    }
//    public function setRememberToken($value)
//    {
//        $this->remember_token = $value;
//    }


    public function getFuncionarioFullNameDepartamentoAttribute()
    {
        return $this->attributes['apellidos'].' '.$this->attributes['nombres']. ' ( ' . $this->departamento()->first()->denominacion .' )';
    }

    public function getFuncionarioFullNameDepartamentoDistritoAttribute()
    {
        return $this->attributes['apellidos'].' '.$this->attributes['nombres']. ' (' . $this->departamento()->first()->denominacion .' - Distrito ' . $this->distrito()->first()->codigoSemplades . ')';
    }

    




}





