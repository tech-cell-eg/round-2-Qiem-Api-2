<?php

namespace App\Http\Controllers\Inspector;

use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;

class RealEstateController extends Controller
{
    use ApiResponseTrait;
     //show all real-estate
     public function index(){
        $realEstates=\App\Models\Real_estate::with('user')->paginate(10);
        if ($realEstates->isEmpty()) {
            return $this->errorResponse("No real estates found", 404);
        }
        return $this->successResponse($realEstates, "All real estates retrieved successfully");
    }

    public function show($id){
        $realEstate=\App\Models\Real_estate::with('user')->find($id);
        if(!$realEstate){
            return $this->errorResponse("Real estate not found", 404);
        }
        return $this->successResponse($realEstate, "Real estate details retrieved successfully");
    }
}
