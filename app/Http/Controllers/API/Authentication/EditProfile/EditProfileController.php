<?php

namespace App\Http\Controllers\Api\authentication\EditProfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class EditProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $user = auth()->user(); // Get authenticated user

        // Validate request
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:255',
        ]);

        // Update user profile
        $user->update($request->only('name', 'email', 'phone', 'city'));

        return response()->json([
            'message' => 'Profile updated successfully.',
            'user' => $user
        ], 200);
    }

    /**
     * Update user password
     */
    public function updatePassword(Request $request)
    {
        $user = auth()->user(); // Get authenticated user

        // Validate request
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        // Check if the current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['Current password is incorrect.']
            ]);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return response()->json(['message' => 'Password updated successfully.'], 200);
    }
}
