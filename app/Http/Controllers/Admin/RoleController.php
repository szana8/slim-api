<?php

namespace App\Http\Controllers\Admin;

use App\Eloquent\Admin\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Role\AccessRequest;
use App\Http\Requests\Role\CreateRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Http\Requests\Role\DestroyRequest;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Eloquent\Criteria\EagerLoad;
use App\Transformers\Authorization\RoleTransformer;
use App\Repositories\Contracts\PermissionRepository;

class RoleController extends Controller
{
    /**
     * Base object of the Role repository.
     *
     * @var Role
     */
    protected $role;

    /**
     * Base object of the Permissions repository.
     *
     * @var
     */
    protected $permission;


    /**
     * RoleController constructor.
     *
     * @param RoleRepository       $role
     * @param PermissionRepository $permission
     */
    public function __construct(RoleRepository $role, PermissionRepository $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @param AccessRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(AccessRequest $request)
    {
        $roles = $this->role->withCriteria([
            new EagerLoad(['permissions', 'team']),
        ])->search($request->search)->paginate();

        return fractal()->collection($roles)->transformWith(new TeamTransformer)->includeRoles()->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest|Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        try {
            $role = $this->role->create([
                'name' => $request->name,
                'display_name' => $request->display_name,
                'description' => $request->description,
            ])->syncPermissions($request->permissions);

            return $this->show($role->id);
        }
        catch (\Exception $e) {
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
            $role = $this->role->withCriteria([
                new EagerLoad(['permissions', 'team']),
            ])->find($id);

            return fractal()->item($role)->transformWith(new RoleTransformer)->includePermissions()->toArray();
        }
        catch (ModelNotFoundException $e) {
            return fractal()->item($e)->transformWith(new ExceptionTransformer)->toArray();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $role = $this->role->fill($id, [
                'name' => $request->name,
                'display_name' => $request->display_name,
                'description' => $request->description,
            ])->syncPermissions($request->permissions);

            return $this->show($role->id);
        }
        catch (\Exception $e) {
            return fractal()->item($e)->transformWith(new ExceptionTransformer)->toArray();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(DestroyRequest $request, $id)
    {
        try {
            $this->role->delete($id);

            return response(null, 204);
        }
        catch (Exception $e) {
            return fractal()->item($e)->transformWith(new ExceptionTransformer)->toArray();
        }
    }
}
