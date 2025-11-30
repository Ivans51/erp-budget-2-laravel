<?php

namespace App\Http\Controllers\V1\Auth;

use App\Domain\Org\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\V1\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Handle a login request to the application.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $user = User::where('email', $validatedData['email'])->first();

        if (!$user || !Hash::check($validatedData['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Create Sanctum token
        $token = $user->createToken('auth_token')->plainTextToken;

        return Response::success([
            'user' => new UserResource($user),
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 'Login successful');
    }

    /**
     * Handle a logout request to the application.
     */
    public function logout(Request $request): JsonResponse
    {
        // Revoke the token that was used to authenticate the current request
        $request->user()->currentAccessToken()->delete();

        return Response::success(null, 'Logged out successfully');
    }

    /**
     * Get the authenticated user's information.
     */
    public function me(Request $request): JsonResponse
    {
        return Response::success([
            'user' => new UserResource($request->user()),
        ]);
    }
}
