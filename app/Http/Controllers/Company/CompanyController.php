<?php
namespace App\Http\Controllers\Company;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;

class CompanyController extends Controller
{
    use ApiResponseTrait;
    public function finish($id){
        $project=Project::find($id);
        if(!$project){
            return $this->errorResponse("Project not found", 404);
        }
        if($project->status==='ended'){
            return $this->errorResponse("Project is already ended", 400);
        }
        $project->update(['status'=>'ended']);
        return $this->successResponse($project, "Project marked as completed successfully");
    }
}
