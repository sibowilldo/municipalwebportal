<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StateColorFormRequest extends FormRequest
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
            'name' => 'required|unique:state_colors',
            'css_class' => 'required',
            'css_color' => 'required',
            'css_font_color' => 'required'
        ];
    }
}
