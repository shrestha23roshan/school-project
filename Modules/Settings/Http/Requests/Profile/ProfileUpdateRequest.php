<?php

namespace Modules\Settings\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required',
            'full_name' => 'required',
            'designation' => 'required',
            'image_icon' => 'mimes:jpg,jpeg,gif,png',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username field is required.',
            'full_name.required' => 'Full Name field is required.',
            'designation.required' => 'Designation field is required.'
        ];
    }
}
