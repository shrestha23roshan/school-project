<?php

namespace Modules\ContentManagement\Http\Requests\Notice;

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
            'subject' => 'required|max:145',
            'date' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'subject.required' => 'Subject field is required.',
            'date.required' => 'Date field is required.',
            'description.required' => 'Description field is required.',
        ];
    }
}