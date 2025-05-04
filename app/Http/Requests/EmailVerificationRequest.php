<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailVerificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:users,id',  // ✅ Fixed table name
            'hash' => 'required|string',
        ];
    }

    public function validationData()
    {
        return array_merge($this->route()->parameters(), $this->query());
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        abort(403, 'Validation failed: ' . json_encode($validator->errors()->all()));
    }
}
