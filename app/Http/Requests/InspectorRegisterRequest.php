<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InspectorRegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|unique:users,phone',
            'password' => 'required|string|min:8', // Enforcing minimum 8 chars
            'city' => 'nullable|string',
            'inspection_fee' => 'required|numeric|min:0',
            'national_id' => 'required|string|unique:inspectors,national_id',
            'certificate' => 'required|string',
            'province' => 'nullable|string',
            'area' => 'nullable|string',
        ];
    }
    public function messages(): array
    {
        return [
            'email.unique' => 'This email is already in use.',
            'phone.unique' => 'This phone number is already in use.',
            'password.min' => 'Password must be at least 8 characters.',
            'national_id.unique' => 'This national ID is already registered.',
        ];
    }
}
