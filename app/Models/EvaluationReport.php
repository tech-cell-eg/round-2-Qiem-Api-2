<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EvaluationReport extends Model
{
    use HasFactory;

    protected $table = 'evaluation_reports';

    protected $fillable = [
        'inspector_id',
        'evaluation_date',
        'instrument_date',
        'infrastructure',
        'instrument_number',
        'property_location',
        'property_code',
        'source',
        'distance',
        'entry_date',
        'property_boundaries',
        'within_range',
        'attributed',
        'building_condition',
        'general_description_of_finishing',
        'number_of_floor',
        'evaluation_of_floors',
        'land_evaluation',
        'building_evaluation',
        'total_property_coast',
        'marketing_value',
        'property_comparisons',
        'measurement',
        'general_notes',
        'photos_of_property',
        'file',
        'property_type',
        'property_description',
        'property_age',
        'ready_to_use',
        'service_id',
    ];
}
