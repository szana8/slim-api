<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use JWTAuth;
use Carbon\Carbon;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    /**
     * @param RegisterFormRequest $request
     */
    public function signUp(RegisterFormRequest $request)
    {
        $user = User::create([
            'name'     => $request->json('name'),
            'email'    => $request->json('email'),
            'password' => bcrypt($request->json('password')),
        ]);

        $token = JWTAuth::attempt($request->only('email', 'password'), [
            'exp' => Carbon::now()->addWeek()->timestamp,
        ]);

        return response()->json([
            'data' => $user,
            'meta' => [
                'token' => $token
            ]
        ], 200);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function signIn(LoginRequest $request)
    {
        try {
            $token = JWTAuth::attempt($request->only('email', 'password'), [
                'exp' => Carbon::now()->addWeek()->timestamp,
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Could not authenticate',

            ], 500);
        }

        if (! $token) {
            return response()->json([
                'error' => 'Could not authenticate',
            ], 401);
        }

        return response()->json(compact('token'));
    }
}
