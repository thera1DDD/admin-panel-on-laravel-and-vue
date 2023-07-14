<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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
        $userId = User::where('email',$this->email)->first();
        return [
            'name' => 'required|string',
            'surname' => 'nullable|string',
            'patronymic' => 'nullable|string',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($userId->id ?? null),
            ],
            'photo' => 'nullable',
            'password' => 'nullable|string',
            'phone' => 'nullable|string',
            'role' => 'required|string',
        ];
    }
}
