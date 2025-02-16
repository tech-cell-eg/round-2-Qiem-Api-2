<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRealEstateRequest extends FormRequest
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
            'review_notes' => 'required|string',
            'review_file' => 'required|file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'review_notes.required' => 'The review notes are required.',
            'review_file.required' => 'A review file is required.',
            'review_file.mimes' => 'The file must be a PDF, DOC, DOCX, JPG, or PNG.',
            'review_file.max' => 'The file size must not exceed 2MB.',
        ];
    }
}
