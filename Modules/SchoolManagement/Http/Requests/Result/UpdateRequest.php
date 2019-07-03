<?php

namespace Modules\SchoolManagement\Http\Requests\Result;

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
            'registration_no' => 'required',
            'class' => 'required',
            'remark' => 'required|max:1|alpha|regex: /\b[pPfF]/'
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Full Name field is required.',
            'registration_no.required' => 'Registration Number field is required.',
            'class.required' => 'Class Field is required',
            'remark.required' => 'Remark Field is required',
        ];
    }
}