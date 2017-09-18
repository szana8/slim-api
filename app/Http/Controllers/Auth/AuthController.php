<?php

namespace App\Http\Controllers\Auth;

use JWTAuth;
use Carbon\Carbon;
use App\Models\User;
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
        User::create([
            'name'     => $request->json('name'),
            'email'    => $request->json('email'),
            'password' => bcrypt($request->json('password')),
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function signIn(Request $request)
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
