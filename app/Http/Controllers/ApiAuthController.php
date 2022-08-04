<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $this->data['token'] = $request->user()->createToken('Api_token')->plainTextToken;

            $this->message = 'Welcome ' . $request->user()->name;

            $this->has_err = false;

        } else {
            $this->message = 'Invalid credentials';
        }

        return $this->sendResponse();
    }
}
