<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Contracts\TeamRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Eloquent\Criteria\EagerLoad;
use App\Repositories\Contracts\TeamRolesRepository;
use App\Http\Requests\TeamRole\AccessRequest;
use App\Http\Requests\TeamRole\CreateRequest;
use App\Http\Requests\TeamRole\DestroyRequest;
use App\Repositories\Eloquent\Criteria\EagerLoadWithCriteria;
use Illuminate\Support\Facades\Auth;

class TeamRolesController extends Controller
{
    /**
     * @var TeamRolesRepository
     */
    protected $teamRolesRepository;

    /**
     * @var TeamRepository
     */
    protected $teamRepository;

    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    /**
     * Permissions for the create functionality.
     *
     * @var array
     */
    protected $createPermissions = ['create-teamrole'];

    /**
     * Permissions for the update functionality.
     *
     * @var array
     */
    protected $updatePermissions = ['update-teamrole'];

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * TeamRolesController constructor.
     *
     * @param TeamRolesRepository $teamRolesRepository
     * @param TeamRepository $teamRepository
     * @param RoleRepository $roleRepository
     * @param UserRepository $userRepository
     */
    public function __construct(TeamRolesRepository $teamRolesRepository,
                                TeamRepository $teamRepository,
                                RoleRepository $roleRepository,
                                UserRepository $userRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
        $this->teamRepository = $teamRepository;
        $this->teamRolesRepository = $teamRolesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param AccessRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(AccessRequest $request)
    {
        $teamRoles = $this->teamRolesRepository->withCriteria([
            new EagerLoad(['users', 'team.users']),
        ])->search($request->searchTeamRoles)->get();

        return view('admin.team_role.index', ['teamroles' => $teamRoles, 'teams' => $this->teamRepository->all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $this->userRepository->find($request->user)->attachRole($this->roleRepository->find($request->role), $request->team);

        return back()->with('message', $this->teamRepository->find($request->team)->display_name.' team has been successfully added!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param $roleId
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $roleId)
    {
        if (Auth::user()->hasPermission($this->updatePermissions)) {
            $teamRoles = $this->roleRepository->withCriteria([
                new EagerLoadWithCriteria('team', 'user_id', $id),
                new EagerLoadWithCriteria('users', 'id', $id),
            ])->findWhere('id', $roleId)->get();

            return view('admin.team_role._create', ['teamRoles' => $teamRoles, 'teams' => $this->teamRepository->all()]);
        }

        throw new AccessDeniedHttpException('This action is unauthorized!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyRequest $request, $id)
    {
        $this->userRepository->find($request->user)->detachRole($this->roleRepository->find($request->role), $id);

        return back()->with('message', $this->teamRepository->find($id)->display_name.' team has been successfully removed!');
    }
}
