<?php

namespace App\Http\Controllers\API\Client;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Client\ProjectResource;
use App\Models\Offer;
use App\Models\Project;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $offerId = Offer::Where('client_id', auth()->user()->id)->pluck('id');
        $status = $request->status;
        $projects = Project::whereIn('offer_id', $offerId)
            ->filterByStatus($status)
            ->get();
        if ($projects->isNotEmpty()) {
            return ApiResponse::sendResponse(Response::HTTP_OK, 'All projects', ProjectResource::collection($projects));
        } else {
            return ApiResponse::sendResponse(Response::HTTP_NOT_FOUND, 'No projects yet');
        }
    }

    public function show($id)
    {
        $offerId = Offer::Where('client_id', auth()->user()->id)->pluck('id');
        $project = Project::whereIn('offer_id', $offerId)->where('id', $id)->first();
        $projectDetails = [
            'company' => $project->offer->company,
            'real_estate' => [
                'type' => $project->offer->real_estate->type,
                'street' => $project->offer->real_estate->street,
                'district' => $project->offer->real_estate->district,
                'city' => $project->offer->real_estate->city,
                'area' => $project->offer->real_estate->area,
                'region' => $project->offer->real_estate->region,
                'advantages' => $project->offer->real_estate->advantages,
                'more_details' => $project->offer->real_estate->more_details
            ]
        ];
        if ($project) {
            return ApiResponse::sendResponse(Response::HTTP_OK, 'Project details', $projectDetails);
        } else {
            return ApiResponse::sendResponse(Response::HTTP_NOT_FOUND, 'Error');
        }
    }
}
