<?php

namespace App\Http\Controllers\Inspector;

use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;

class RequestController extends Controller
{
    use ApiResponseTrait;
     //to show all request
     public function index(){
        $allRequest=\App\Models\Request::with(['company','real_estate'])->paginate(10);
        if($allRequest->isEmpty()){
            return $this->errorResponse("No Request found",404);
        }
        return $this->successResponse($allRequest,"All requests retrieved successfully");
    }

    public function show($id)
    {
    $request = \App\Models\Request::with(['company', 'real_estate'])->find($id);

    if (!$request) {
        return response()->json(["message" => "Request not found"], 404);
    }

    return response()->json([
        "message" => "Request details retrieved successfully",
        "data" => $request
    ]);
    }
}
