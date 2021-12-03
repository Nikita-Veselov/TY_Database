<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDeviceRequest extends FormRequest
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
            'code' => 'required|max:255',
            'name' => 'required|max:255',
            'class' => 'required|max:255',
            'date' => 'required|max:255',
        ];
    }
    public function messages()
    {
        return [
            'code.required' => 'Введите фамилию',
            'name.required' => 'Введите имя',
            'class.required' => 'Введите класс точности',
            'date.required' => 'Введите дату',
        ];
    }
}
