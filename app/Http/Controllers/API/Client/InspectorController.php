<?php

namespace App\Http\Controllers\API\Client;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Client\InspectorResource;
use App\Http\Resources\Client\ProjectResource;
use App\Models\Inspector;
use App\Models\Project;
use http\Client\Curl\User;
use Illuminate\Http\Response;

class InspectorController extends Controller
{
    public function getInspectorByProject($project_id)
    {
        $inspector_id = Project::where('id', $project_id)
            ->where('client_id', auth()->user()->id)
            ->select('inspector_id', 'description')
            ->first();
        if ($inspector_id == null) {
            return ApiResponse::sendResponse(Response::HTTP_NOT_FOUND, 'No projects yet');
        }
        $user = \App\Models\User::where('id', $inspector_id->inspector_id)->first();
        $user['description'] = $inspector_id->description;
        if ($user != null) {
            return ApiResponse::sendResponse(Response::HTTP_OK, 'All projects', new InspectorResource($user));
        } else {
            return ApiResponse::sendResponse(Response::HTTP_NOT_FOUND, 'No projects yet');
        }
    }
}
