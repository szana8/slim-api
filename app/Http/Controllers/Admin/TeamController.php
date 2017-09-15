<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Team\AccessRequest;
use App\Http\Requests\Team\CreateRequest;
use App\Http\Requests\Team\UpdateRequest;
use App\Http\Requests\Team\DestroyRequest;
use App\Repositories\Contracts\TeamRepository;
use App\Repositories\Contracts\PermissionRepository;

class TeamController extends Controller
{
    /**
     * Base object of the Team repository.
     *
     * @var TeamRepository
     */
    protected $team;

    /**
     * Base object of the Permission repository.
     *
     * @var PermissionRepository
     */
    protected $permission;

    /**
     * Permissions for the create functionality.
     *
     * @var array
     */
    protected $createPermissions = ['create-team'];

    /**
     * Permissions for the update functionality.
     *
     * @var array
     */
    protected $updatePermissions = ['update-team'];

    /**
     * TeamController constructor.
     *
     * @param TeamRepository       $team
     * @param PermissionRepository $permission
     */
    public function __construct(TeamRepository $team, PermissionRepository $permission)
    {
        $this->team = $team;
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
        $teams = $this->team->search($request->search)->paginate();

        return view('admin.team.index', ['teams' => $teams]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasPermission($this->createPermissions)) {
            return view('admin.team.create', ['permissions' => $this->permission->all()]);
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
        $this->team->create($request->toArray());

        return back()->with('message', $request->name.' team has been successfully created!');
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
            return view('admin.team.create', ['team' => $this->team->find($id)]);
        }

        throw new AccessDeniedHttpException('This action is unauthorized!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param int               $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->team->find($id)->update($request->toArray());

        return back()->with('message', $request->name.' team has been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param int                $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyRequest $request, $id)
    {
        $this->team->delete($id);

        return back()->with('message', 'The selected team has been successfully deleted!');
    }
}
