<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Balance extends FormRequest
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
            'users_id' => 'required',
            'balance' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'users_id.required' => 'User ID Tidak Boleh Kosong',
            'balance.required' => 'Saldo Tidak Boleh Kosong',
        ];
    }
}
