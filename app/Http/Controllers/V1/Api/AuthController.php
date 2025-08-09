<?php

namespace App\Http\Controllers\V1\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Api\Auth\LoginRequest;
use App\Http\Requests\V1\Api\Auth\RegisterRequest;
use App\Services\Services\AuthService;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $result = $this->authService->register($request->validated());

        if ($result === false) {
            return apiError(
                message: 'Failed to register',
                code: Response::HTTP_UNAUTHORIZED,
                errors: [
                    'error' => 'Invalid credentials',
                ]
            );
        }

        return apiSuccess(
            data: $result,
            message: 'Successfully registered',
            code: Response::HTTP_CREATED
        );
    }

    public function login(LoginRequest $request)
    {
        $result = $this->authService->login($request->validated());

        if ($result === false) {
            return apiError(
                message: 'Failed to login',
                code: Response::HTTP_UNAUTHORIZED,
                errors: [
                    'error' => 'Invalid credentials',
                ]
            );
        }

        return apiSuccess(
            data: [
                'token' => $result,
                'expires_in' => auth('api')->factory()->getTTL() * 60, // Convert minutes to seconds
            ],
            message: 'Successfully logged in',
            code: Response::HTTP_OK
        );
    }

    public function logout()
    {
        $result = $this->authService->logout();

        if ($result === false) {
            return apiError(
                message: 'Failed to logout',
                code: Response::HTTP_INTERNAL_SERVER_ERROR,
                errors: [
                    'error' => 'Something went wrong',
                ]
            );
        }

        return apiSuccess(
            data: [],
            message: 'Successfully logged out',
            code: Response::HTTP_OK
        );
    }
}
