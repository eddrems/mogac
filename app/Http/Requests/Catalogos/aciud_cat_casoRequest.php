<?php namespace App\Http\Requests\Catalogos;

use App\Http\Requests\Request;

class aciud_cat_casoRequest extends Request {

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
            'id_servicio' => 'required|numeric',
            'denominacion' => 'required'
        ];
    }


}
