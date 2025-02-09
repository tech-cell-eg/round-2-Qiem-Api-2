<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
}
