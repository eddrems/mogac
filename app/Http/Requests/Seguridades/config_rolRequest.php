<?php namespace App\Http\Requests\Seguridades;

use App\Http\Requests\Request;

class config_rolRequest extends Request {

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
            'denominacion_visual' => 'required',
            'esta_vigente' => 'required',
            'nivel_zonal' => 'required',
            'nivel_nacional' => 'required',
            'nivel_distrital' => 'required'
        ];
    }


}
