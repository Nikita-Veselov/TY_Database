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
        ];
    }
}
