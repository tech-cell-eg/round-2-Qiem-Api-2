<?php

namespace App\Http\Controllers;

use App\Models\Inspector;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;

class InspectorController extends Controller
{
    use ApiResponseTrait;
    //Show inspector's balance and outstanding balance.
    public function show($id){
        $inspector = Inspector::where('inspector_id', $id)->first();
        if(!$inspector){
            return $this->errorResponse('Inspector not found',404);
        }
        $data=[
            'account_balance' => $inspector->balance . ' ريال',
            'outstanding_balance' => $inspector->outstanding_balance . ' ريال',
        ];
        return $this->successResponse($data,'Inspector balance details retrieved successfully');
    }

    //Show all paid projects for a specific inspector.
    public function showPaidProjects($id){
        $inspector = Inspector::where('inspector_id', $id)->first();
        if (!$inspector) {
            return $this->errorResponse("Inspector not found", 404);
        }
        // $paidProjects = $inspector->projects()->where('is_paid', 1)->get();
        $paidProjects=Project::where('inspector_id',$id)->where('is_paid',1)->get();
        if($paidProjects->isEmpty()){
            return $this->errorResponse('No paid projects found for this inspector', 404);
        }
            $data=$paidProjects->map(function($project){
                return[
                    'id'=>$project->id,
                    'description' => $project->description,
                    'comment' => $project->comment,
                    'resume_file' => $project->resume_file,
                    'status' => $project->status,
                    'is_paid' => $project->is_paid ? 'مدفوع' : 'غير مدفوع',
                    'created_at' => $project->created_at->format('Y-m-d H:i:s'),
                ];
            });
            return $this->successResponse($data,'All paid projects retrieved successfully');

    }
}
