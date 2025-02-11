<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use App\Models\Real_estate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaymentController extends Controller
{
    public function index()
    {
        $real_estate_ids = Real_estate::where('client_id', auth()->user()->id)->pluck('id');

        $payd = Payment::where('status', 'paid')
            ->whereIn('real_estates_id', $real_estate_ids) // Use whereIn for multiple IDs
            ->get();

        if ($payd->isNotEmpty()) {
            return ApiResponse::sendResponse(Response::HTTP_OK, 'Your paid real Estate', PaymentResource::collection($payd));
        } else {
            return ApiResponse::sendResponse(Response::HTTP_NOT_FOUND, 'Real estate not exist');
        }
    }
}
