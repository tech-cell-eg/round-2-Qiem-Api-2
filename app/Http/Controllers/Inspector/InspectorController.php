<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Inspector;
use Illuminate\Http\Request;
use App\Models\InspectorReport;
use App\Models\Real_estate;
use App\Models\Request as ModelsRequest;
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

    //to store report
    public function store(Request $request){
     $validateData=$request->validate([
        'inspector_id' => 'required|exists:inspectors,inspector_id',
            'evaluation_date' => 'required|date',
            'instrument_date' => 'required|date',
            'infrastructure' => 'nullable|in:yes,no',
            'instrument_number' => 'required|string',
            'property_location' => 'required|string',
            'property_code' => 'required|string',
            'Source' => 'required|string',
            'distance' => 'required|numeric',
            'Entry_date' => 'required|numeric',
            'property_boundaries' => 'required|array',
            'within_range' => 'required|string',
            'attributed' => 'required|string',
            'building_condition' => 'required|string',
            'general_description_of_finishing' => 'required|string',
            'number_of_floor' => 'required|integer',
            'evaluation_of_floors' => 'required|string',
            'land_evaluation' => 'required|string',
            'building_evaluation' => 'required|string',
            'total_property_coast' => 'required|numeric',
            'marketing_value' => 'required|numeric',
            'property_comparisons' => 'required|string',
            'measurement' => 'required|string',
            'general_notes' => 'nullable|string',
            'photos_of_property' => 'nullable|string',
            'file' => 'nullable|string',
            'property_type' => 'required|string',
            'property_description' => 'required|string',
            'property_age' => 'required|string',
            'Ready_to_use' => 'nullable|in:yes,no',
            'service_id' => 'required|exists:services,id',
        ]);
        //create report
        $report=InspectorReport::create($validateData);
        return $this->successResponse($report,'report created successfully');

    }

}
