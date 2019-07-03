<?php

namespace Modules\SchoolManagement\Http\Requests\Result;

use Illuminate\Foundation\Http\FormRequest;

class ImportStoreRequest extends FormRequest
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
           'file' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'file.!! Please upload a valid xls/csv file..!!',
           
        ];
    }
}