<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    use ApiResponseTrait;


    public function show(string $id)
    {
        $property = Property::find($id);
        if (!$property) {
            return $this->errorResponse('العقار غير موجود', [], 404);
        }
    
        return $this->successResponse('Property details', $property);

    }

}
