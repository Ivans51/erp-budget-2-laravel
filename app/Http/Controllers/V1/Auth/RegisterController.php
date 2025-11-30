<?php

namespace App\Http\Controllers\V1\Auth;

use App\Domain\Org\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\V1\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * @group Authentication
 *
 * Endpoints for user authentication and session management.
 */
class RegisterController extends Controller
{
    /**
     * Register User
     *
     * Register a new user with name, email, and password. The user will be automatically logged in and receive an access token.
     *
     * @apiRoute POST /api/v1/auth/register
     *
     * @bodyParam name string required The user's full name. Example: John Doe
     * @bodyParam email string required The user's email address (must be unique). Example: user@example.com
     * @bodyParam password string required The user's password (minimum 8 characters). Example: password123
     * @bodyParam password_confirmation string required Password confirmation (must match password). Example: password123
     *
     * @response 201 {
     *   "success": true,
     *   "message": "Registration successful",
     *   "data": {
     *     "user": {
     *       "id": 1,
     *       "name": "John Doe",
     *       "email": "user@example.com",
     *       "email_verified_at": null,
     *       "created_at": "2023-12-01T10:00:00.000000Z",
     *       "updated_at": "2023-12-01T10:00:00.000000Z"
     *     },
     *     "access_token": "1|abcdef1234567890",
     *     "token_type": "Bearer"
     *   }
     * }
     * @response 422 {
     *   "message": "The email has already been taken.",
     *   "errors": {
     *     "email": ["The email has already been taken."]
     *   }
     * }
     * @response 422 {
     *   "message": "The password field is required.",
     *   "errors": {
     *     "password": ["The password field is required."]
     *   }
     * }
     * @response 422 {
     *   "message": "Password confirmation does not match.",
     *   "errors": {
     *     "password": ["Password confirmation does not match."]
     *   }
     * }
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

        return Response::success([
            'user' => new UserResource($user),
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 'Registration successful', 201);
    }
}
