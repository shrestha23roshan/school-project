<?php

namespace Modules\ContentManagement\Http\Requests\Download;

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
            'heading' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'heading.required' => 'Heading field is required.'
        ];
    }
}