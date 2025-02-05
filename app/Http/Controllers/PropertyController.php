<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;

class PropertyController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::all();

        return $this->successResponse('All properties', $properties);
    }

}
