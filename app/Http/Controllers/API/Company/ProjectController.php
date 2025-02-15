<?php

namespace App\Http\Controllers\API\Company;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Company\PaidProjectResource;
use App\Http\Resources\Company\ProjectResource;
use App\Models\Payment;
use App\Models\Project;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    public function index()
    {
        $project = Project::where('company_id', '3')->get();
        if($project->isNotEmpty()){
            return ApiResponse::sendResponse(Response::HTTP_OK, 'All projects', ProjectResource::collection($project));
        }else{
            return ApiResponse::sendResponse(Response::HTTP_NOT_FOUND, 'No projects yet');
        }
    }
    public function show($id)
    {
        $project = Project::where('company_id', '3')->where('id',$id)->first();
        if($project){
            return ApiResponse::sendResponse(Response::HTTP_OK, 'Projects details', new ProjectResource($project));
        }else{
            return ApiResponse::sendResponse(Response::HTTP_NOT_FOUND, 'Error');
        }
    }
    public function paidProjects()
    {
        $projects_id = Project::where('company_id', '3')->pluck('id');
        $paidProjects = Payment::whereIn('project_id', $projects_id)
            ->where('status', 'paid')
            ->get();
        if ($paidProjects->isNotEmpty()) {
            return ApiResponse::sendResponse(Response::HTTP_OK, 'Paid projects', PaidProjectResource::collection($paidProjects));
        } else {
            return ApiResponse::sendResponse(Response::HTTP_NOT_FOUND, 'No Paid projects yet');
        }
    }

    public function comments($id)
    {
        $project = Project::where('company_id', '3')->where('id',$id)->first();
        if($project){
            return ApiResponse::sendResponse(Response::HTTP_OK, 'Projects comments', $project->comment);
        }else{
            return ApiResponse::sendResponse(Response::HTTP_NOT_FOUND, 'Error');
        }
    }
}
