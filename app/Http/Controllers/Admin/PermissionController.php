<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\UpdateRequest;
use App\Http\Requests\Permission\AccessRequest;
use App\Http\Requests\Permission\CreateRequest;
use App\Http\Requests\Permission\DestroyRequest;
use App\Repositories\Eloquent\Criteria\EagerLoad;
use App\Repositories\Contracts\PermissionRepository;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class PermissionController extends Controller
{
    /**
     * Base object of the Permission repository.
     *
     * @var
     */
    protected $permission;

    /**
     * Permissions for the create functionality.
     *
     * @var array
     */
    protected $createPermissions = ['create-permission'];

    /**
     * Permissions for the update functionality.
     *
     * @var array
     */
    protected $updatePermissions = ['update-permission'];

    /**
     * PermissionController constructor.
     *
     * @param PermissionRepository $permission
     */
    public function __construct(PermissionRepository $permission)
    {
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
        $permissions = $this->permission->withCriteria([
            new EagerLoad(['roles', 'users']),
        ])->search($request->search)->paginate();

        return view('admin.permission.index', ['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasPermission($this->createPermissions)) {
            return view('admin.permission.create');
        }

        throw new AccessDeniedHttpException('This action is unauthorized!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $this->permission->create($request->toArray());

        return back()->with('message', $request->name . ' permission has been successfully created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->hasPermission($this->updatePermissions)) {
            return view('admin.permission.create', ['permission' => $this->permission->find($id)]);
        }

        throw new AccessDeniedHttpException('This action is unauthorized!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->permission->find($id)->update($request->toArray());

        return back()->with('message', $request->name . ' permission has been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyRequest $request, $id)
    {
        $this->permission->delete($id);

        return back()->with('message', $request->name . ' permission has been successfully deleted!');
    }
}
