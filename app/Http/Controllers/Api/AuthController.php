<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function login(LoginRequest $request)
    {

        if (Auth::attempt($request->validated())) {

            /** @var \App\Models\User $user */
            $user = Auth::user();
            $token = $user->createToken('user-token')->accessToken;

            return $this->response(['token' => $token], 200);
        } else {
            return $this->response(['error' => 'Unauthorized'], 401);
        }
    }

    function noLogged()
    {
        return $this->response(['error' => 'Unauthorized'], 401);
    }
}
