<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\UserTransformer;
use App\Transformers\ExceptionTransformer;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Eloquent\Criteria\EagerLoad;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * UserController constructor.
     *
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->withCriteria([
            new EagerLoad(['roles', 'roles.team']),
        ])->paginate();

        return fractal()->collection($users, new UserTransformer())->includeRoles()->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserCreateRequest|Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        try {
            $user = $this->user->create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => $request->password,
            ])->syncRoles($request->roles);

            return $this->show($user->id);
        } catch (\Exception $e) {
            return fractal()->item($e, new ExceptionTransformer())->toArray();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = $this->user->withCriteria([
                new EagerLoad(['roles', 'roles.team']),
            ])->find($id);

            return fractal()->item($user, new UserTransformer())
                            ->includeRoles()
                            ->toArray();
        } catch (ModelNotFoundException $e) {
            return fractal()->item($e, new ExceptionTransformer())->toArray();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest|Request $request
     * @param int                       $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $user = $this->user->fill($id, [
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => $request->password,
            ])->syncRoles($request->roles);

            return $this->show($user->id);
        } catch (Exception $e) {
            return fractal()->item($e, new ExceptionTransformer())->toArray();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->user->delete($id);

            return response(null, 204);
        } catch (Exception $e) {
            return fractal()->item($e, new ExceptionTransformer())->toArray();
        }
    }
}
