<?php

namespace App\Http\Controllers\API\Company;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Company\Real_estateResource;
use App\Models\Offer;
use App\Models\Real_estate;
use Illuminate\Http\Response;

class Real_estateController extends Controller
{
    public function index()
    {
        $real_estate_ids = Offer::where('company_id', 3)->pluck('real_estate_id');
        if ($real_estate_ids->isNotEmpty()) {
            $real_estates = Real_estate::whereIn('id', $real_estate_ids)->get();
            return ApiResponse::sendResponse(Response::HTTP_OK, 'All real estates', Real_estateResource::collection($real_estates));
        }

        return ApiResponse::sendResponse(Response::HTTP_OK, 'No real estates yet');
    }

}
