<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateWorkerRequest extends FormRequest
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
            'name1' => 'required|max:255',
            'name2' => 'required|max:255',
            'name3' => 'required|max:255',
            'position' => 'required|max:255',
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name1.required' => 'Введите фамилию',
            'name2.required' => 'Введите имя',
            'name3.required' => 'Введите отчество',
            'position.required' => 'Выберите должность',
        ];
    }
}
