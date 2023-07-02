<?php

namespace App\Http\Requests\TestResult;

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
            'tests_id' => 'required|string',
            'users_id'=>'required',
            'tests_type'=>'nullable|string',
            'questions_total' => 'required',
            'questions_correct' => 'required',
            'is_passed' => 'required',
            'passing_time' => 'required',
            'passed_percent'=>'nullable'
        ];
    }
}
