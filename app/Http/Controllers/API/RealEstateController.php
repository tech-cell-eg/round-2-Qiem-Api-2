<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Real_estateResource;
use App\Models\Real_estate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class RealEstateController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => ['required', 'string'],
            'street' => ['required', 'string'],
            'district' => ['required', 'string'],
            'city' => ['required', 'string'],
            'area' => ['required', 'string'],
            'region' => ['required', 'string'],
            'advantages' => ['required', 'string'],
            'more_details' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return ApiResponse::sendResponse(Response::HTTP_UNPROCESSABLE_ENTITY, ' Craete real estates validation error', $validator->errors());
        }
        $real_estate = Real_estate::create(array(
            'type' => $request->input('type'),
            'street' => $request->input('street'),
            'district' => $request->input('district'),
            'city' => $request->input('city'),
            'area' => $request->input('area'),
            'region' => $request->input('region'),
            'advantages' => $request->input('advantages'),
            'more_details' => $request->input('more_details'),
            'client_id' => auth()->user()->id,
        ));
        return ApiResponse::sendResponse(Response::HTTP_CREATED, 'Real Estate created successfully', $real_estate);

    }

    public function delete(Request $request, $id, $client_id)
    {
        $real_estate = Real_estate::where('id', $id)->where('client_id', $client_id)->first();

        // Check if the record exists before attempting to delete
        if ($real_estate) {
            $real_estate->delete(); // Deletes the record
            return ApiResponse::sendResponse(Response::HTTP_OK, 'Real Estate deleted successfully');
        } else {
            return ApiResponse::sendResponse(Response::HTTP_NOT_FOUND, 'Real estate not exist', $real_estate);
        }
    }

    public function update(Request $request, $id, $client_id)
    {
        $real_estate = Real_estate::where('id', $id)->where('client_id', $client_id)->first();
        if ($real_estate) {
            $real_estate->type = $request->type;
            $real_estate->street = $request->street;
            $real_estate->district = $request->district;
            $real_estate->city = $request->city;
            $real_estate->area = $request->area;
            $real_estate->region = $request->region;
            $real_estate->advantages = $request->advantages;
            $real_estate->more_details = $request->more_details;
            $real_estate->save();
            return ApiResponse::sendResponse(Response::HTTP_OK, 'Real Estate updated successfully');
        }else {
            return ApiResponse::sendResponse(Response::HTTP_NOT_FOUND, 'Real estate not exist', $real_estate);
        }

    }
}
