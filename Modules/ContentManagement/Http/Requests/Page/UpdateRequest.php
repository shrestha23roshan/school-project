<?php

namespace Modules\ContentManagement\Http\Requests\Page;

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
            'heading' => 'required',
            'description' => 'required',
            'meta_title' => 'required'        
        ];
    }

    public function message()
    {
        return [
            'heading.required' => 'Heading Field is required.',
            'description.required' => 'Description Field is required.',
            'meta_title.required' => 'Meta Title Field is Required.'
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
