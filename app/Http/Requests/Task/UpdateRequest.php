<?php

namespace App\Http\Requests\Task;

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
            'modules_id' => 'nullable',
            'word' => 'required',
            'description' => 'required',
            'name' => 'nullable',
            'number' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'poster' => 'nullable',
            'code' => 'nullable',
        ];
    }
}
