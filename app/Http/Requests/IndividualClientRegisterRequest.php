<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndividualClientRegisterRequest extends FormRequest
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
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'phone'                 => 'required|string|unique:users,phone',
            'mobile_number'         => 'required', 'string', 'unique:users,mobile_number',
            'password'              => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
            'city'                  => 'required|string|max:255',
            'street'                => 'required|string|max:255',
            'district'              => 'required|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'password.confirmed' => 'Password confirmation does not match.',
            'email.unique'       => 'This email is already registered.',
            'phone.unique'       => 'This phone number is already registered.',
        ];
    }
}
