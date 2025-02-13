<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamMemberRequest extends FormRequest
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
            'role' => 'required|in:Inspector,Reviewer',
            'inspector_id' => 'nullable|required_if:role,Inspector|exists:inspectors,inspector_id',
            'reviewer_id' => 'nullable|required_if:role,Reviewer|exists:reviewers,reviewer_id',
        ];
    }

    public function messages(): array
    {
        return [
            'role.required' => 'Role is required.',
            'role.in' => 'Role must be either Inspector or Reviewer.',
            'inspector_id.required_if' => 'Inspector ID is required for an Inspector role.',
            'inspector_id.exists' => 'Inspector ID must exist in the inspectors table.',
            'reviewer_id.required_if' => 'Reviewer ID is required for a Reviewer role.',
            'reviewer_id.exists' => 'Reviewer ID must exist in the reviewers table.',
        ];
    }
}
