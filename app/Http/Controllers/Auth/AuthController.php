<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use App\Transformers\UserTransformer;
use JWTAuth;
use Carbon\Carbon;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\DataArraySerializer;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    /**
     * @param RegisterFormRequest $request
     * @return \Illuminate\Http\JsonResponse
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

        $resource = new Item($user, new UserTransformer(), 'user');
        $resource->setMetaValue('token', $token);

        $manager = new Manager();
        $manager->setSerializer(new DataArraySerializer());

        return $manager->createData($resource)->toArray();
    }

    /**
     * @param LoginRequest|Request $request
     * @return array|\Illuminate\Http\JsonResponse
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

        $resource = new Item($request->user(), new UserTransformer(), 'user');
        $resource->setMetaValue('token', $token);

        $manager = new Manager();
        $manager->setSerializer(new DataArraySerializer());

        return $manager->createData($resource)->toArray();

    }

    public function signedIn(Request $request)
    {
        return fractal()->item($request->user(), new UserTransformer())->toArray();
    }
}
