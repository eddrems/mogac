<?php namespace App\Http\Requests\Catalogos;

use App\Http\Requests\Request;

class rrhh_departamentoRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'denominacion' => 'required',
            'esta_vigente' => 'required',
            'aplicable_nacional' => 'required',
            'aplicable_zonal' => 'required',
            'aplicable_distrito' => 'required',
            'bloqueado' => 'required',
            'permite_asignacion_multiple' => 'required',

        ];
    }


}
