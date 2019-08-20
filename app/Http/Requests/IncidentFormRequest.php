<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IncidentFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'location_description' => 'required|string|max:255',
            'latitude' => 'required|string|max:20',
            'longitude' => 'required|string|max:20',
            'category_id' => 'required',
            'type_id' => 'required',
            'suburb_id' => 'required'
        ];
    }
}
