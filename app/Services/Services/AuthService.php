<?php

namespace App\Services\Services;

use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    public function register($request)
    {
        return \DB::transaction(function () use ($request) {
            try {

                $user = User::create($request);

                $token = JWTAuth::fromUser($user);

                return [
                    'user' => $user,
                    'token' => $token,
                ];
            } catch (\Exception $e) {
                \Log::error($e);

                return false;
            }
        });
    }

    public function login($request)
    {
        if (! $token = JWTAuth::attempt($request)) {
            return false;
        }

        return $token;
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
        } catch (JWTException $e) {
            \Log::error($e);

            return false;
        }

        return true;
    }
}
