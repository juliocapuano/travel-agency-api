<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public const API_AUTH_TOKEN = 'api_auth_token';

    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = $this->attemp($request);

        abort_if(!$user, 401, __('No valid Credentials'));

        $token = $user->createToken(self::API_AUTH_TOKEN);

        return \Response::json([
            'message'      => __('successfully'),
            'user'         => $user,
            'bearer_token' => $token->plainTextToken,
        ], 201);
    }

    public function logout(Request $request): \Illuminate\Http\Response
    {
        \Auth::user()->currentAccessToken()->delete();

        return \Response::noContent();
    }

    private function attemp(Request $request): ?User
    {
        $valid_data = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->input('email'))->first();

        return \Hash::check($request->input('password'), $user->password) ? $user : null;
    }
}
