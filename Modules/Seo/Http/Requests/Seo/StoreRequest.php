<?php

namespace Modules\Seo\Http\Requests\Seo;

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
            'meta_title' => 'required',
            'meta_tags' => 'required|max:255',
            'meta_description' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'meta_title.required' => 'Meta Title field is required.',
            'meta_tags.required' => 'Meta Tags field is required.',
            'meta_description.required' => 'Meta Description field is required.'
        ];
    }
}