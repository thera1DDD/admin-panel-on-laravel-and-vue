<?php

namespace App\Http\Requests\TestResult;

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
            'tests_id' => 'nullable|string',
            'users_id'=>'nullable',
            'questions_total' => 'nullable',
            'questions_correct' => 'nullable',
            'is_passed' => 'nullable',
            'passing_time' => 'nullable',
        ];
    }
}
