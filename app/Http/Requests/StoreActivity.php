<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActivity extends FormRequest
{
    /**
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => 'required|max:255',
            'route'         => 'required|file',
            'description'   => 'nullable|max:500' 
        ];
    }

    /**
     * Customize The Error Messages Returned
     *
     * @return array
     */
    public function messages(): array 
    {
        return [
            'title.required'        => 'Please provide a title for the activity',
            'title.max:255'         => 'Please ensure the title is less than 255 characters',
            'route.required'        => 'Please select a .gpx file to upload',
            'description.max:500'   => 'Please ensure the description is less than 500 characters',
        ];
    }
}
