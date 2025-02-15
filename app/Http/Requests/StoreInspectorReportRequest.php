<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInspectorReportRequest extends FormRequest
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
            'inspector_id' => 'required|exists:inspectors,inspector_id',
            'evaluation_date' => 'required|date',
            'instrument_date' => 'required|date',
            'infrastructure' => 'nullable|in:yes,no',
            'instrument_number' => 'required|string',
            'property_location' => 'required|string',
            'property_code' => 'required|string',
            'Source' => 'required|string',
            'distance' => 'required|numeric',
            'Entry_date' => 'required|numeric',
            'property_boundaries' => 'required|array',
            'within_range' => 'required|string',
            'attributed' => 'required|string',
            'building_condition' => 'required|string',
            'general_description_of_finishing' => 'required|string',
            'number_of_floor' => 'required|integer',
            'evaluation_of_floors' => 'required|string',
            'land_evaluation' => 'required|string',
            'building_evaluation' => 'required|string',
            'total_property_coast' => 'required|numeric',
            'marketing_value' => 'required|numeric',
            'property_comparisons' => 'required|string',
            'measurement' => 'required|string',
            'general_notes' => 'nullable|string',
            'photos_of_property' => 'nullable|string',
            'file' => 'nullable|string',
            'property_type' => 'required|string',
            'property_description' => 'required|string',
            'property_age' => 'required|string',
            'Ready_to_use' => 'nullable|in:yes,no',
            'service_id' => 'required|exists:services,id',
        ];
    }
}
