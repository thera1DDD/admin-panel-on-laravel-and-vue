<?php

namespace App\Http\Requests\Stat;

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
            'passed_courses_id' => 'nullable|integer',
            'passed_modules_id' => 'nullable|integer',
            'passed_videos_id' => 'nullable|integer',
            'users_id' => 'nullable|integer',
            'passed_tests_id' => 'nullable|integer',
            'passed_tasks_id' => 'nullable|integer',

        ];
    }
}
