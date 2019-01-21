<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CsvRequest extends FormRequest
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
            'csv' => 'required|file|mimes:csv,txt'
        ];
    }

    /**
     * Send a callback message in case of non validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'file.mimes' => 'Le fichier doit être de type csv.'
        ];
    }
}
