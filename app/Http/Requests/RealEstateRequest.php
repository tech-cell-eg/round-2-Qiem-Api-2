<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RealEstateRequest extends FormRequest
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
            'type' => ['required', 'string'],
            'street' => ['required', 'string'],
            'district' => ['required', 'string'],
            'city' => ['required', 'string'],
            'area' => ['required', 'string'],
            'region' => ['required', 'string'],
            'advantages' => ['required', 'string'],
            'more_details' => ['required', 'string'],
           // 'client_id' => auth()->user()->id,
        ];
    }
}
