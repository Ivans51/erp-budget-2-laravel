<?php

namespace App\Http\Controllers\V1\Auth;

use App\Domain\Org\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\V1\UserResource;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    /**
     * Handle a registration request to the application.
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        // Method 1: Using validated() - returns only validated data
        $validatedData = $request->validated();

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ]);

        // Create Sanctum token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->success([
            'user' => new UserResource($user),
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 'Registration successful', 201);
    }
}
