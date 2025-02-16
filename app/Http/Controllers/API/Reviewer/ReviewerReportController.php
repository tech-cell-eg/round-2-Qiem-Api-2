<?php

namespace App\Http\Controllers\API\Reviewer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EvaluationReport;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


class ReviewerReportController extends Controller
{
    ////Show reports pending review
    public function index(): JsonResponse
    {
        $reports = EvaluationReport::where('status', 'pending')->with('inspector')->get();

        return response()->json([
            'message' => 'Pending reports retrieved successfully',
            'reports' => $reports
        ]);
    }

    //Show a single report by ID.
    public function show($id): JsonResponse
    {
        $report = EvaluationReport::with('inspector')->find($id);

        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }

        return response()->json([
            'message' => 'Report retrieved successfully',
            'report' => $report
        ]);
    }

    //Accept or reject a report
    public function review(Request $request, $id): JsonResponse
    {
        $report = EvaluationReport::find($id);

        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }

        $validated = $request->validate([
            'status' => 'required|in:accepted,rejected',
            'company_response' => 'nullable|string',
        ]);

        $report->update([
            'status' => $validated['status'],
            'company_response' => $validated['company_response'] ?? null,
            'reviewer_id' => Auth::id(),
        ]);

        return response()->json([
            'message' => 'Report reviewed successfully',
            'report' => $report
        ]);
    }
}
