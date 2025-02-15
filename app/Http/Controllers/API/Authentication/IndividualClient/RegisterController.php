<?php

namespace App\Http\Controllers\Api\Authentication\IndividualClient;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndividualClientRegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\IndividualClient;

class RegisterController extends Controller
{
    public function register(IndividualClientRegisterRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        // Create User
        $user = User::create(
            $validated
        );

        // Create Individual Client Entry
        IndividualClient::create(['user_id' => $user->id]);

        // Generate Sanctum Token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'    => 'Individual client registered successfully',
            'user'       => $user->makeHidden(['password', 'remember_token', 'created_at', 'updated_at']),
            'token'      => $token,
            'token_type' => 'Bearer'
        ], 201);
    }
}
