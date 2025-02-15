<?php

namespace App\Http\Controllers\API\Client;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\IndividualClient;
use App\Models\EvaluationCompany;
use App\Models\Inspector;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'street' => ['required', 'string'],
            'district' => ['required', 'string'],
            'city' => ['required', 'string'],
            'role' => ['required'],
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return ApiResponse::sendResponse(Response::HTTP_UNPROCESSABLE_ENTITY, 'Registeration validation error', $validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'street' => $request->street,
            'district' => $request->district,
            'city'=>$request->city,
            'role'=>'client',
            'password' => Hash::make($request->password),
        ]);

        $data['token'] = $user->createToken('Real estates')->plainTextToken;
        $data['name'] = $user->name;
        $data['email'] = $user->email;

        return ApiResponse::sendResponse(Response::HTTP_CREATED, 'User created successfully', $data);

    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        $role = $this->getUserRole($user->id);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'role' => $role,
            'token' => $token,
        ]);
    }

   // Logout Method
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete(); // Revoke all tokens
        return response()->json(['message' => 'Logged out successfully']);
    }



    // Helper function to determine user role
    private function getUserRole($userId)
    {
        if (IndividualClient::where('user_id', $userId)->exists()) {
            return 'individual_client';
        }
        if (EvaluationCompany::where('user_id', $userId)->exists()) {
            return 'evaluation_company';
        }
        if (Inspector::where('user_id', $userId)->exists()) {
            return 'inspector';
        }
        return 'unknown';
    }
}
