<?php

namespace App\Http\Requests\Test;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required|string',
            'testable_type'=>'required|string',
            'testable_id'=>'nullable',
            'number' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'poster' => 'nullable',
            'code' => 'required',
        ];
    }
}
