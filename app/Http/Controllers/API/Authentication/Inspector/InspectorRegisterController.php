<?php

namespace App\Http\Controllers\Api\Authentication\Inspector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inspector;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class InspectorRegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|unique:users,phone',
            'password' => 'required|string|min:6',
            'city' => 'nullable|string',
            'inspection_fee' => 'required|numeric|min:0',
            'national_id' => 'required|string|unique:inspectors,national_id',
            'certificate' => 'required|string',
            'province' => 'nullable|string',
            'area' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'city' => $request->city,
        ]);

        // Register inspector linked to user
        $inspector = Inspector::create([
            'user_id' => $user->id,
            'inspection_fee' => $request->inspection_fee,
            'national_id' => $request->national_id,
            'certificate' => $request->certificate,
            'province' => $request->province,
            'area' => $request->area,
        ]);

        // Generate Sanctum token for authentication
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Inspector registered successfully',
            'user' => $user,
            'inspector' => $inspector,
            'token' => $token, // Return token for immediate authentication
        ], 201);
    }
}
