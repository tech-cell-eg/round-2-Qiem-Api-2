<?php

// namespace App\Http\Controllers\Api\Authentication\EvaluationCompany;

// use App\Http\Controllers\Controller;
// use App\Http\Requests\EvaluationCompanyRegisterRequest;
// use App\Models\User;
// use App\Models\EvaluationCompany;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;


// class EvaluationCompanyRegisterController extends Controller
// {
//     public function register(Request $request)
//     {
//         $validated = $request->validated();
//         $validated['password'] = Hash::make($validated['password']);
//         $user = User::create(
//             $validated
//         );

//         // Create evaluation company linked to user
//         $evaluationCompany = EvaluationCompany::create([
//             'user_id' => $user->id,
//             'tax_number' => $request->tax_number,
//             'authorization' => $request->authorization,
//         ]);

//         // Generate Sanctum token
//         $token = $user->createToken('auth_token')->plainTextToken;

//         return response()->json([
//             'message' => 'Evaluation Company registered successfully',
//             'user' => $user,
//             'evaluation_company' => $evaluationCompany,
//             'token' => $token,
//         ], 201);
//     }
// }
namespace App\Http\Controllers\Api\Authentication\EvaluationCompany;

use App\Http\Controllers\Controller;
use App\Http\Requests\EvaluationCompanyRegisterRequest;
use App\Models\User;
use App\Models\EvaluationCompany;
use Illuminate\Support\Facades\Hash;

class EvaluationCompanyRegisterController extends Controller
{
    public function register(EvaluationCompanyRegisterRequest $request)
    {
        // Get validated data from request
        $validated = $request->validated();

        // Hash the password before storing it
        $validated['password'] = Hash::make($validated['password']);

        // Create a new user
        $user = User::create($validated);

        // Create an evaluation company linked to the user
        $evaluationCompany = EvaluationCompany::create([
            'user_id' => $user->id,
            'tax_number' => $request->tax_number,
            'authorization' => $request->authorization,
        ]);

        // Generate a Sanctum token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Evaluation Company registered successfully',
            'user' => $user,
            'evaluation_company' => $evaluationCompany,
            'token' => $token,
        ], 201);
    }
}
