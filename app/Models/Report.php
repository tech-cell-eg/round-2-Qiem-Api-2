<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'inspector_id',
        'property_code',
        'evaluation_date',
        'general_dscription',
        'location_dscription',
        'instrument_number',
        'instrument_date',
        'property_type',
        'infrastructure',
        'services',
        'ready_to_use',
        'number',
        'part_number',
        'source',
        'entry_type',
        'space',
        'north',
        'north_height',
        'south',
        'south_height',
        'east',
        'east_height',
        'west',
        'west_height',
        'elevation',
        'property_status',
        'finishing_description',
        'number_of_floors',
        'land_rating',
        'buildings_rating',
        'total_property_costs',
        'marketing_value',
        'property_comparisons',
        'conflict_of_interest',
        'measurement',
        'preview',
        'general_inspectors_comments',
        'property_images',
        'report_copy',
        'final_report',
    ];
}
