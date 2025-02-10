<?php

namespace App\Http\Controllers\Api\Authentication\EvaluationCompany;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EvaluationCompany;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function register(Request $request)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'city' => 'nullable|string|max:255',
            'tax_number' => 'required|string|unique:evaluation_company,tax_number',
            'authorization' => 'required|string',
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'city' => $request->city,
        ]);

        // Create evaluation company linked to user
        $evaluationCompany = EvaluationCompany::create([
            'user_id' => $user->id,
            'tax_number' => $request->tax_number,
            'authorization' => $request->authorization,
        ]);

        // Generate Sanctum token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Evaluation Company registered successfully',
            'user' => $user,
            'evaluation_company' => $evaluationCompany,
            'token' => $token,
        ], 201);
    }
}
