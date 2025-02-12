<?php

namespace App\Http\Controllers\Api\Authentication\IndividualClient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\IndividualClient;
// use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Log::info('Received Password: ' . $request->password);
        // Log::info('Received Password Confirmation: ' . $request->password_confirmation);



        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required|string|unique:users,phone',
            'password' => 'required|string|min:6',
            'city'     => 'required|string|max:255',
        ]);

        // Create User
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'city'     => $request->city,
        ]);

        // Create Individual Client Entry
        IndividualClient::create([
            'user_id' => $user->id,
        ]);

        // Generate Sanctum Token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'  => 'Individual client registered successfully',
            'user'     => $user->makeHidden(['id', 'created_at', 'updated_at']),
            'token'    => $token,
        ], 201);
    }
}
