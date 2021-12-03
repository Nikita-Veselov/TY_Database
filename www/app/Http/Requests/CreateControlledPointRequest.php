<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateControlledPointRequest extends FormRequest
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
            'code' => 'required|max:255|unique:controlled_points',
            'name' => 'required|max:255',
            'type' => 'required|max:255',
        ];
    }
    
    public function messages()
    {
        return [
            'code.required' => 'Введите код',
            'name.required' => 'Введите имя',
            'type.required' => 'Введите тип',
        ];
    }
}
