<?php


namespace App\Http\Responses\Admin\Role;


use App\Repositories\Contracts\RoleRepository;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Auth;

class AccessRoleResponse implements Responsable
{
    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    /**
     * StoreRoleResponse constructor.
     * @param RoleRepository $roleRepository
     */
    public function __construct($roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request $request
     * @return AccessRoleResponse
     * @throws \InvalidArgumentException
     */
    public function toResponse($request)
    {
        if ($request->wantsJson())
            return $this->apiResponse($request);

        return $this->webResponse($request);
    }

    /**
     * Return the role response for the web routes.
     *
     * @param $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function webResponse($request)
    {
        return view('admin.role.index', ['roles' => $this->roleRepository, 'hasPermission' => Auth::user()->hasPermission('create-role')]);
    }

    /**
     * Return the role response for the api routes.
     *
     * @param $request
     * @return $this
     * @throws \InvalidArgumentException
     */
    protected function apiResponse($request)
    {
        return response()->json($this->roleRepository)->setStatusCode(201);
    }
}