<?php

namespace App\Http\Controllers\API\Reviewer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRealEstateRequest;
use App\Models\Real_estate;


class RealEstateReviewController extends Controller
{
    public function store(ReviewRealEstateRequest $request, $id)
    {
        $realEstate = Real_estate::findOrFail($id);

        // Store the uploaded file in 'public/reviews' directory
        $filePath = $request->file('review_file')->store('reviews', 'public');

        // Update the real estate record with review details
        $realEstate->update([
            'review_notes' => $request->review_notes,
            'review_file' => $filePath,
        ]);

        return response()->json([
            'message' => 'Review submitted successfully.',
            'data' => $realEstate
        ], 200);
    }
}
