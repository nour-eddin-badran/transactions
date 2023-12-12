<?php

namespace App\Services\Auth;

use App\Exceptions\UserException;
use App\Models\User;
use App\Modules\EnumManager\Enums\GeneralEnum;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Api\User as UserResource;

class AuthService
{
    public function __construct(private User $user) { }

    public function login(string $email, string $password): UserResource
    {
        $user = $this->user->whereEmail(['email' => $email])->first();

        if (!$user) {
            throw new UserException(__('messages.email_not_registered'), GeneralEnum::NOT_REGISTERED, Response::HTTP_NOT_FOUND);
        }

        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            throw new UserException(__('messages.invalid_credentials'), GeneralEnum::INVALID_CREDENTIALS, Response::HTTP_UNAUTHORIZED);
        }

        $token = $this->generateAccessToken($user);
        return new UserResource($user, $token);
    }

    private function generateAccessToken(User $user): string
    {
        // clear all previous tokens
        $user->tokens()->delete();

        return $user->createToken('token')->plainTextToken;
    }

}
