<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AccessTokenController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'string|max:225'
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $device_name = $request->post('device_name',$request->userAgent());
            $token = $user->createToken($device_name);

            return response()->json([
                'code' => 1,
                'token' => $token->plainTextToken,
                'user' => $user,
            ],201);
        }
        return response()->json([
            'code' => 0,
            'message' => 'Invalid credentials'
        ],401);
    }
}


