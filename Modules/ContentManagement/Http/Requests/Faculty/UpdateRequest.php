<?php

namespace Modules\ContentManagement\Http\Requests\Faculty;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'full_name' => 'required',
            'designation' => 'required',
            'department' => 'required',
            'type' => 'required'
        ];
    }

    public function message()
    {
        return [
            'full_name.required' => 'Full Name Field is required.',
            'designation.required' => 'Designation Field is required.',
            'department.required' => 'Department Field is Required.',
            'type.required' => 'Type Field is required.'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user();
    }
}
