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

/**
 * @group Authentication
 *
 * Endpoints for user authentication and session management.
 */
class LoginController extends Controller
{
    /**
     * Login User
     *
     * Authenticate a user with their email and password and return an access token.
     *
     * @apiRoute POST /api/v1/auth/login
     *
     * @bodyParam email string required The user's email address. Example: user@example.com
     * @bodyParam password string required The user's password. Example: password123
     *
     * @response 200 {
     *   "success": true,
     *   "message": "Login successful",
     *   "data": {
     *     "user": {
     *       "id": 1,
     *       "name": "John Doe",
     *       "email": "user@example.com",
     *       "email_verified_at": "2023-12-01T10:00:00.000000Z",
     *       "created_at": "2023-12-01T10:00:00.000000Z",
     *       "updated_at": "2023-12-01T10:00:00.000000Z"
     *     },
     *     "access_token": "1|abcdef1234567890",
     *     "token_type": "Bearer"
     *   }
     * }
     * @response 422 {
     *   "message": "The provided credentials are incorrect.",
     *   "errors": {
     *     "email": ["The provided credentials are incorrect."]
     *   }
     * }
     * @response 422 {
     *   "message": "The email field is required.",
     *   "errors": {
     *     "email": ["The email field is required."]
     *   }
     * }
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
     * Logout User
     *
     * Logout the authenticated user by revoking their current access token.
     *
     * @apiRoute POST /api/v1/auth/logout
     *
     * @authenticated
     *
     * @header Authorization string required Bearer token for authentication. Example: Bearer 1|abcdef1234567890
     *
     * @response 200 {
     *   "success": true,
     *   "message": "Logged out successfully",
     *   "data": null
     * }
     * @response 401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function logout(Request $request): JsonResponse
    {
        // Revoke the token that was used to authenticate the current request
        $request->user()->currentAccessToken()->delete();

        return Response::success(null, 'Logged out successfully');
    }

    /**
     * Get User Profile
     *
     * Get the authenticated user's profile information.
     *
     * @apiRoute GET /api/v1/auth/me
     *
     * @authenticated
     *
     * @header Authorization string required Bearer token for authentication. Example: Bearer 1|abcdef1234567890
     *
     * @response 200 {
     *   "success": true,
     *   "message": null,
     *   "data": {
     *     "user": {
     *       "id": 1,
     *       "name": "John Doe",
     *       "email": "user@example.com",
     *       "email_verified_at": "2023-12-01T10:00:00.000000Z",
     *       "created_at": "2023-12-01T10:00:00.000000Z",
     *       "updated_at": "2023-12-01T10:00:00.000000Z"
     *     }
     *   }
     * }
     * @response 401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function me(Request $request): JsonResponse
    {
        return Response::success([
            'user' => new UserResource($request->user()),
        ]);
    }
}
