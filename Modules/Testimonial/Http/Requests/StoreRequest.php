<?php

namespace Modules\Testimonial\Http\Requests;

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
            'full_name' => 'required',
            'designation' => 'required',
            'description' => 'required',
            'attachment' => 'mimes:jpg,jpeg,gif,png'
            ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Full Name field is required.',
            'designation.required' => 'Designation field is required.',
            'description.required' => 'Description field is required.',
            'attachment.required' => 'Attachment field is required.'
        ];
    }
}