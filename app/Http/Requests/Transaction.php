<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Transaction extends FormRequest
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
            'from_users_id' => 'required',
            'to_users_id' => 'required',
            'balance' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'from_users_id.required' => 'User ID Pengirim Tidak Boleh Kosong',
            'to_users_id.required' => 'User ID Penerima Tidak Boleh Kosong',
            'balance.required' => 'Saldo Tidak Boleh Kosong',
        ];
    }
}
