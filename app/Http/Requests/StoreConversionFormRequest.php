<?php

namespace App\Http\Requests;

use App\Http\Requests\APIRequest;

class StoreConversionFormRequest extends APIRequest
{
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
            'integer' => 'required|numeric|min:1|max:3999'
        ];
    }

    public function all($keys = null)
    {
        $data = parent::all($keys);
        $data['integer'] = $this->route('integer');
        return $data;
    }
}
