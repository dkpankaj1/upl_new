<?php

namespace App\Http\Controllers\Api;

use App\Enums\StatusCodeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Resources\AuthUserResource;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthSessionController extends Controller
{
    use HttpResponses;
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        if (Auth::user()->currentAccessToken()) {
            Auth::user()->currentAccessToken()->delete();
        }
        
        $data = [
            'user' => new AuthUserResource(Auth::user()),
            'token' => Auth::user()->createToken($request->throttleKey())->plainTextToken,
        ];

        return $this->sendSuccess("login success", $data, StatusCodeEnum::OK);

    }
    public function destroy(Request $request)
    {
        Auth::user()->tokens()->delete();
        return $this->sendSuccess("logout success",[],StatusCodeEnum::OK);
    }
}
