<?php

namespace App\Http\Controllers\Inspector;

use App\Models\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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

    //accept request
    public function acceptRequest($id){
        $request=Request::find($id);
        if(!$request){
            return $this->errorResponse("Request not found", 404);
        }
        if ($request->status !== 'pending') {
            return $this->errorResponse("Only pending requests can be accepted", 400);
        }
        $validator=Validator::make(['status'=>'accepted'],[
            'status'=>'in:accepted,rejected',
        ]);
        if($validator->fails()){
            return $this->errorResponse($validator->errors(), 422);
        }
        $request->update(['status' => 'accepted']);
        return $this->successResponse($request, "Request accepted successfully");
    }

    public function cancelRequest($id){
        $request=Request::find($id);
        if(!$request){
            return $this->errorResponse("Request not found", 404);
        }
        if ($request->status !== 'pending') {
            return $this->errorResponse("Only pending requests can be accepted", 400);
        }
        $validator=Validator::make(['status'=>'rejected'],[
            'status'=>'in:accepted,rejected',
        ]);
        if($validator->fails()){
            return $this->errorResponse($validator->errors(), 422);
        }
        $request->update(['status' => 'rejected']);
        return $this->successResponse($request, "Request rejected successfully");
    }
}
