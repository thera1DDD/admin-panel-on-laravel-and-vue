<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
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
        $currentUser = User::select('id')->where('email',$this->email)->first();
        $currentUser = $currentUser['id'];
        return [
            'name' => 'required|string',
            'surname' => 'nullable|string',
            'patronymic' => 'nullable|string',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->where(function ($query) use ($currentUser) {
                    $query->where('id', '!=', $currentUser);
                }),
            ],
            'photo' => 'nullable',
            'password' => 'nullable|string',
            'phone' => 'nullable|string',
            'role' => 'required|string',
        ];
    }
}
