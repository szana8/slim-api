<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\UserTransformer;
use App\Transformers\ExceptionTransformer;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Repositories\Contracts\RoleRepository;
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
     * @var RoleRepository
     */
    protected $role;

    /**
     * UserController constructor.
     *
     * @param UserRepository $user
     * @param RoleRepository $role
     */
    public function __construct(UserRepository $user, RoleRepository $role)
    {
        $this->user = $user;
        $this->role = $role;
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

        // Return with the collection of users
        return fractal()->collection($users)->transformWith(new UserTransformer)->includeRoles()->toArray();
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

            // Return the user data
            return $this->show($user->id);

        }
        catch(\Exception $e) {
            // If we can not create the user, return an exception message and code
            return fractal()->item($e)->transformWith(new ExceptionTransformer)->toArray();
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

            // Return the user attributes with roles
            return fractal()->item($user)->transformWith(new UserTransformer)->includeRoles()->toArray();

        }
        catch (ModelNotFoundException $e) {
            // If we not found the user return an exception message and code
            return fractal()->item($e)->transformWith(new ExceptionTransformer)->toArray();
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

            // Return the user data
            return $this->show($user->id);

        }
        catch(Exception $e) {
            // If we can not update the user, return an exception message and code
            return fractal()->item($e)->transformWith(new ExceptionTransformer)->toArray();
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

        }
        catch (Exception $e) {
            // If we can not delete the user, return an exception message and code
            return fractal()->item($e)->transformWith(new ExceptionTransformer)->toArray();
        }

    }
}
