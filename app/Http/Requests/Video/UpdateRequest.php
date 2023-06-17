<?php

namespace App\Http\Requests\Video;

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
            'name' => 'required',
            'description' => 'required',
            'modules_id'=> 'required',
            'number' => 'required',
            'video_file' => 'nullable',
            //'video_file' => 'nullable|mimetypes:video/mp4,video/avi|max:1000000',
            'poster' => 'nullable',
            'code' => 'required',

        ];
    }
}
