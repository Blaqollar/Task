<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admins')->attempt($credentials)) {
            $token = JWTAuth::fromUser(Auth::guard('admins')->user());
            return response()->json(compact('token'));
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }
}
