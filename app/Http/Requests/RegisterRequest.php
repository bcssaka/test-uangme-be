<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|exists:roles,code',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'phone_number' => 'required|string|max:15|unique:users,phone_number',
            'id_number' => 'required|string|max:20',
            'id_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'monthly_income' => 'required|numeric',
            'tax_id_number' => 'sometimes|required_if:role,lender|string|max:20',
        ];
    }
}
