<?php

namespace App\Http\Controllers\V1\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Api\Auth\LoginRequest;
use App\Http\Requests\V1\Api\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        try {
            $token = JWTAuth::fromUser($user);
        } catch (JWTException $e) {
            return apiError(
                error: 'Could not create token',
                code: 500,
                errors: [
                    'error' => $e->getMessage(),
                ]
            );
        }

        return apiSuccess(
            data: [
                'token' => $token,
                'user' => $user,
            ],
            message: 'Successfully registered',
            code: 201);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('phone', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return apiError(
                    error: 'Invalid credentials',
                    code: 401,
                    errors: [
                        'error' => 'Invalid credentials',
                    ]
                );
            }
        } catch (JWTException $e) {
            return apiError(
                error: 'Could not create token',
                code: 500,
                errors: [
                    'error' => $e->getMessage(),
                ]
            );
        }

        return apiSuccess(
            data: [
                'token' => $token,
                'expires_in' => auth('api')->factory()->getTTL() * 60,
            ],
            message: 'Successfully logged in',
            code: 200
        );
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
        } catch (JWTException $e) {
            return apiError(
                error: 'Failed to logout',
                code: 500,
                errors: [
                    'error' => $e->getMessage(),
                ]
            );
        }

        return apiSuccess(
            data: [],
            message: 'Successfully logged out',
            code: 200
        );
    }

    public function getUser()
    {
        try {
            $user = Auth::user();
            if (! $user) {
                return apiError(
                    error: 'User not found',
                    code: 404,
                    errors: [
                        'error' => 'User not found',
                    ]
                );
            }

            return apiSuccess(
                data: $user,
                message: 'Successfully fetched user profile',
                code: 200
            );
        } catch (JWTException $e) {
            return apiError(
                error: 'Failed to fetch user',
                code: 500,
                errors: [
                    'error' => $e->getMessage(),
                ]
            );
        }
    }
}
