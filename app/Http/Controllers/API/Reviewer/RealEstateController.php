<?php

namespace App\Http\Controllers\API\Reviewer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Real_estate;

class RealEstateController extends Controller
{

   ///// Show all properties
    public function index()
    {
        $properties = Real_estate::with('reviewer')->get();
        return response()->json($properties);
    }
/// Retrieve details of a real estate property by its Id
    public function show($id)
    {
        $property = Real_estate::with('reviewer')->findOrFail($id);
        return response()->json($property);
    }
}
