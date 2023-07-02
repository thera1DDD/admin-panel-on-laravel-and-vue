<?php

namespace App\Http\Requests\TaskResult;

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
            'tasks_id' => 'nullable',
            'users_id'=>'nullable',
            'is_passed' => 'nullable',
            'passing_time' => 'nullable',
        ];
    }
}
