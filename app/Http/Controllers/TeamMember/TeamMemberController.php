<?php

namespace App\Http\Controllers\TeamMember;
use App\Http\Requests\StoreTeamMemberRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeamMember;
use Illuminate\Http\JsonResponse;

class TeamMemberController extends Controller
{
    public function store(StoreTeamMemberRequest $request): JsonResponse
    {
        $teamMember = TeamMember::create($request->validated());

        return response()->json([
            'message' => 'Team Member created successfully!',
            'data' => $teamMember
        ], 201);
    }

    public function index(): JsonResponse
    {
        $teamMembers = TeamMember::with(['inspector', 'reviewer'])->get();

        return response()->json($teamMembers);
    }
}
