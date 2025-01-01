<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvestRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'amount' => 'required|numeric|min:0.01',
            'bank' => 'required|string|in:BCA,BRI,BNI,Mandiri',
        ];
    }
}
