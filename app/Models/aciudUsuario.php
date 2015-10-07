<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class aciudUsuario extends Model  {

    protected $table = 'aciud_usuario';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;





    public function validarCedulaIdentidad($identificacion)
    {
        $cedval = 0;

        if(is_numeric($identificacion)){
            $total_caracteres = strlen($identificacion); // se suma el total de caracteres
            if($total_caracteres==10){//compruebo que tenga 10 digitos la cedula
                $nro_region=substr($identificacion, 0,2);//extraigo los dos primeros caracteres de izq a der
                if($nro_region>=1 && $nro_region<=24){// compruebo a que region pertenece esta cedula//
                    $ult_digito=substr($identificacion, -1,1);//extraigo el ultimo digito de la cedula
                    //extraigo los valores pares//
                    $valor2=substr($identificacion, 1, 1);
                    $valor4=substr($identificacion, 3, 1);
                    $valor6=substr($identificacion, 5, 1);
                    $valor8=substr($identificacion, 7, 1);
                    $suma_pares=($valor2 + $valor4 + $valor6 + $valor8);
                    //extraigo los valores impares//
                    $valor1=substr($identificacion, 0, 1);
                    $valor1=($valor1 * 2);
                    if($valor1>9){ $valor1=($valor1 - 9); }else{ }
                    $valor3=substr($identificacion, 2, 1);
                    $valor3=($valor3 * 2);
                    if($valor3>9){ $valor3=($valor3 - 9); }else{ }
                    $valor5=substr($identificacion, 4, 1);
                    $valor5=($valor5 * 2);
                    if($valor5>9){ $valor5=($valor5 - 9); }else{ }
                    $valor7=substr($identificacion, 6, 1);
                    $valor7=($valor7 * 2);
                    if($valor7>9){ $valor7=($valor7 - 9); }else{ }
                    $valor9=substr($identificacion, 8, 1);
                    $valor9=($valor9 * 2);
                    if($valor9>9){ $valor9=($valor9 - 9); }else{ }
                    $suma_impares=($valor1 + $valor3 + $valor5 + $valor7 + $valor9);
                    $suma=($suma_pares + $suma_impares);
                    $dis=substr($suma, 0,1);//extraigo el primer numero de la suma
                    $dis=(($dis + 1)* 10);//luego ese numero lo multiplico x 10, consiguiendo asi la decena inmediata superior
                    $digito=($dis - $suma);
                    if($digito==10){ $digito='0'; }else{ }//si la suma nos resulta 10, el decimo digito es cero
                    if ($digito==$ult_digito){//comparo los digitos final y ultimo
                        $cedval=1;
                    }else{
                        $cedval=0;
                    }
                }else{
                    $cedval=0;
                }
            }else{
                $cedval=0;
            }
        }else{
            $cedval=0;
        }

        if($cedval == 1){ return true;} else { return false; }
    }









    public function getNombrecompletoCedulaAttribute()
    {
        return $this->attributes['nombres'].'  ( '.$this->attributes['identificacion'].' )'; //return $this->attributes['apellidos'].' '.
    }

    public function getUsuarioFullNameAttribute()
    {
        return $this->attributes['nombres']; //$this->attributes['apellidos'].' '.
    }

    public function genero()
    {
        return $this->belongsTo('App\Models\rrhhFuncionarioGenero', 'id_genero');
    }    
 
    public function tipo_identificacion()
    {
        return $this->belongsTo('App\Models\rrhhTipoIdentificacion', 'id_tipo_identificacion');
    }

    public function ie()
    {
        return $this->belongsTo('App\Models\divInstitucionEducativa', 'id_institucion_educativa');
    }

    public function tipo()
    {
        return $this->belongsTo('App\Models\aciudUsuarioTipo', 'id_ciudadano_tipo');
    }

    public function distrito()
    {
        return $this->belongsTo('App\Models\divDistrito', 'id_distrito');
    }

    public function ciudad()
    {
        return $this->belongsTo('App\Models\divCiudad', 'id_ciudad');
    }








}





