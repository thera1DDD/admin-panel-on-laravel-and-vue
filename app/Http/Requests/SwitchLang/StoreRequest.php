<?php

namespace App\Http\Requests\SwitchLang;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'nullable|string',
            'switch' => 'nullable|string',
            'description' => 'nullable|string',
            'languages_id'=>'required'
        ];
    }
}
