<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\OfferResource;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Real_estate;
use Illuminate\Http\Response;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        $real_estate_ids = Real_estate::where('client_id', auth()->user()->id)->pluck('id');

        $status = $request->query('status'); // Get status from request (optional)

        $offers = Offer::whereIn('real_estate_id', $real_estate_ids)
            ->filterByStatus($status) // Apply the status filter dynamically
            ->get();

        if ($offers->isNotEmpty()) {
            return ApiResponse::sendResponse(Response::HTTP_OK, 'Filtered offers', OfferResource::collection($offers));
        } else {
            return ApiResponse::sendResponse(Response::HTTP_NOT_FOUND, 'No offers found');
        }
    }

    public function show($id)
    {

        $offer = Offer::where('id', $id)->where('client_id', auth()->user()->id)->first(); // Use whereIn()

        if ($offer) {
            return ApiResponse::sendResponse(Response::HTTP_OK, 'Offers details', $offer);
        } else {
            return ApiResponse::sendResponse(Response::HTTP_NOT_FOUND, 'Error');
        }
    }

    public function updateOfferStatus(Request $request, $id)
    {
        $real_estate_ids = Real_estate::where('client_id', auth()->user()->id)->pluck('id');

        $offer = Offer::whereIn('real_estate_id', $real_estate_ids)->where('id', $id)->first();

        if (!$offer) {
            return ApiResponse::sendResponse(Response::HTTP_NOT_FOUND, 'Offer not found');
        }

        $validated = $request->validate([
            'status' => 'required|string|in:refused,hold on,accepted'
        ]);

        $offer->status = $validated['status'];
        $offer->save();

        return ApiResponse::sendResponse(Response::HTTP_OK, 'Offer status updated successfully', new OfferResource($offer));
    }


}
