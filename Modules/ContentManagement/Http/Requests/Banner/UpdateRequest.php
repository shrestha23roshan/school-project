<?php

namespace Modules\ContentManagement\Http\Requests\Banner;

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
            'caption' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'caption.required' => 'Caption field is required.',
            'description.required' => 'Description field is required.',
        ];
    }
}