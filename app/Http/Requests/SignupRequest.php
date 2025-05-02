<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|max:255',
            'date_of_birth' => 'required|date|before:today',
            'phone' => 'required|string|max:11',
            'gender' => 'required',
            'address' => 'required|array',
                'address.province' => 'required|string',
                'address.municipal' => 'required|string',
                'address.barangay' => 'required|string',
                'address.block' => 'required|string',
        ];
    }
}
