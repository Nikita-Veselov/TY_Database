<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRecordRequest extends FormRequest
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
            "number" => 'required|max:255|unique:records',
            "type" => 'required|max:255',
            "date" => 'required|max:255',
            "controlledPoint" => 'required|max:255',
            "device" => 'required|max:255',
            "UTY" => 'required|max:255',
            "UTC" => 'required|max:255',
            "UTP" => 'required|max:255',
            "conclusion" => 'required|max:255',
            "worker1" => 'required|max:255',
            "worker2" => 'required|max:255',
            "worker3" => 'required|max:255',
            "worker4" => 'required|max:255',
        ];
    }
    public function messages()
    {
        return [
            'number.required' => 'Введите номер',
            'type.required' => 'Введите тип',
            'date.required' => 'Введите дату',
            'controlledPoint.required' => 'Выберите КП',
            'device.required' => 'Выберите устройство',
            'UTY.required' => 'Введите напряжение ТУ',
            'UTC.required' => 'Введите напряжение ТС',
            'UTP.required' => 'Введите напряжение ТП',
            'conclusion.required' => 'Введите заключение',
            'worker1.required' => 'Выберите работника 1',
            'worker2.required' => 'Выберите работника 2',
            'worker3.required' => 'Выберите начальника РРУ',
            'worker4.required' => 'Выберите старшего механика',
        ];
    }
}
