<?php
namespace App\Http\Controllers\Inspector;

use Illuminate\Http\Request;
use App\Models\InspectorReport;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\StoreInspectorReportRequest;

class InspectorReportsController extends Controller
{
    use ApiResponseTrait;

    public function store(StoreInspectorReportRequest $request)
    {
        $report = InspectorReport::create($request->validated());
        return $this->successResponse($report, 'Report created successfully');
    }
}
