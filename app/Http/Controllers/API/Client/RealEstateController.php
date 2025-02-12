<?php

namespace App\Http\Controllers\API\Client;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\RealEstateRequest;
use App\Http\Resources\Client\Real_estateResource;
use App\Models\Real_estate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RealEstateController extends Controller
{
    public function index(){
        $realEstates = Real_estate::where('client_id',auth()->user()->id)->get();
        if ($realEstates) {
            return ApiResponse::sendResponse(Response::HTTP_OK, 'All real estates', Real_estateResource::collection($realEstates));
        }
        return ApiResponse::sendResponse(Response::HTTP_OK, 'No real estates yet');
    }
    public function store(RealEstateRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['client_id'] = auth()->user()->id;
        $real_estate = Real_estate::create($validatedData);

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

    public function update(RealEstateRequest $request, $id, $client_id)
    {
        $real_estate = Real_estate::where('id', $id)
            ->where('client_id', $client_id)
            ->first();
        if ($real_estate) {
            $real_estate->update($request->validated());
            return ApiResponse::sendResponse(Response::HTTP_OK, 'Real Estate updated successfully');
        }else {
            return ApiResponse::sendResponse(Response::HTTP_NOT_FOUND, 'Real estate not exist', $real_estate);
        }

    }
}
