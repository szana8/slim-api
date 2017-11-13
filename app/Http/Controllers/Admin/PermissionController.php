<?php

namespace App\Http\Controllers\Admin;

use Spatie\Fractal\Fractal;
use App\Http\Controllers\Controller;
use App\Transformers\ExceptionTransformer;
use App\Http\Requests\Permission\AccessRequest;
use App\Http\Requests\Permission\CreateRequest;
use App\Http\Requests\Permission\UpdateRequest;
use App\Http\Requests\Permission\DestroyRequest;
use App\Repositories\Eloquent\Criteria\EagerLoad;
use App\Repositories\Contracts\PermissionRepository;
use App\Transformers\Authorization\PermissionTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class PermissionController extends Controller
{
    /**
     * Base object of the Permission repository.
     *
     * @var
     */
    protected $permission;

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
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AccessRequest $request)
    {
        $permissions = $this->permission->withCriteria([
            new EagerLoad(['roles', 'users']),
        ])->search($request->search)->get();

        return fractal()->collection($permissions, new PermissionTransformer())
                        ->includeRoles()
                        //->paginateWith(new IlluminatePaginatorAdapter($permissions))
                        ->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     *
     * @return Fractal|array
     */
    public function store(CreateRequest $request)
    {
        try {
            $permission = $this->permission->create([
                'name'         => $request->name,
                'display_name' => $request->display_name,
                'description'  => $request->description,
            ]);

            return $this->show($permission->id);
        } catch (\Exception $e) {
            return fractal()->item($request->all, new ExceptionTransformer())->toArray();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Fractal
     */
    public function show($id)
    {
        try {
            $permission = $this->permission->find($id);

            return fractal()->item($permission, new PermissionTransformer())
                            ->toArray();
        } catch (\Exception $e) {
            return fractal()->item($e, new ExceptionTransformer())->toArray();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param int           $id
     *
     * @return Fractal
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $permission = $this->permission->fill($id, [
                'name'         => $request->name,
                'display_name' => $request->display_name,
                'description'  => $request->description,
            ]);

            return $this->show($permission->id);
        } catch (\Exception $e) {
            return fractal()->item($e, new ExceptionTransformer())->toArray();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param int            $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyRequest $request, $id)
    {
        try {
            $this->permission->delete($id);

            return response(null, 204);
        } catch (\Exception $e) {
            return fractal()->item($e, new ExceptionTransformer())->toArray();
        }
    }
}
