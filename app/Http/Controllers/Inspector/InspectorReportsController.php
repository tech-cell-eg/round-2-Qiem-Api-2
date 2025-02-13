<?php
namespace App\Http\Controllers\Inspector;

use Illuminate\Http\Request;
use App\Models\InspectorReport;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\StoreInspectorReportRequest;
use App\Models\Inspector;

class InspectorReportsController extends Controller
{
    use ApiResponseTrait;

    public function store(StoreInspectorReportRequest $request)
    {
        $report = InspectorReport::create($request->validated());
        return $this->successResponse($report, 'Report created successfully');
    }

    //to ahow all report
    public function index(){
        $inspectors=Inspector::with('reports')->get();
        if ($inspectors->isEmpty()) {
            return $this->errorResponse('No inspectors found', 404);
        }
        return $this->successResponse($inspectors, "All inspectors and their reports retrieved successfully");
    }

    //to show report
    public function show($id){
        $report=InspectorReport::find($id);
        if(!$report){
            return $this->errorResponse("Report not found", 404);
        }
        return $this->successResponse($report,"Report retrieved successfully");
    }
}
