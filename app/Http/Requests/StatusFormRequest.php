<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatusFormRequest extends FormRequest
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
            'name' => 'required|unique:statuses|max:50',
            'description' => 'required|max:255',
            'is_active' => 'required|boolean',
            'state_color_id' => 'required',
            'group' => 'required'
        ];
    }
}
