<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Transformers\ExceptionTransformer;
use App\Http\Requests\TeamRole\AccessRequest;
use App\Http\Requests\TeamRole\CreateRequest;
use App\Http\Requests\TeamRole\DestroyRequest;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Contracts\TeamRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Eloquent\Criteria\EagerLoad;
use App\Transformers\Authorization\RoleTransformer;
use App\Transformers\Authorization\TeamRoleTransformer;
use App\Repositories\Eloquent\Criteria\EagerLoadWithCriteria;

class TeamRolesController extends Controller
{
    /**
     * @var TeamRepository
     */
    protected $teamRepository;

    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * TeamRolesController constructor.
     *
     * @param TeamRepository $teamRepository
     * @param RoleRepository $roleRepository
     * @param UserRepository $userRepository
     */
    public function __construct(TeamRepository $teamRepository, RoleRepository $roleRepository, UserRepository $userRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
        $this->teamRepository = $teamRepository;
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
        $teamRoles = $this->roleRepository->withCriteria([
            new EagerLoad(['users', 'team.users']),
        ])->search($request->searchTeamRoles)->get();

        return fractal()->collection($teamRoles, new RoleTransformer())->toArray();
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
        try {
            $teamRole = $this->userRepository->find($request->user)
                                             ->attachRole($this->roleRepository->find($request->role), $request->team);

            return $this->show($teamRole->id, $request->role);
        } catch (\Exception $e) {
            return fractal()->item($e)->transformWith(new ExceptionTransformer())->toArray();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param $roleId
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, $roleId)
    {
        try {
            $teamRoles = $this->roleRepository->withCriteria([
                new EagerLoadWithCriteria('team', 'user_id', $id),
                new EagerLoadWithCriteria('users', 'id', $id),
            ])->findWhere('id', $roleId)->get();

            return fractal()->collection($teamRoles)->transformWith(new TeamRoleTransformer())->includeTeam()->includeUser()->toArray();
        } catch (\Exception $e) {
            return fractal()->item($e)->transformWith(new ExceptionTransformer())->toArray();
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
            $this->userRepository->find($request->user)->detachRole($this->roleRepository->find($request->role), $id);

            return $this->show($request->user, $request->role);
        } catch (\Exception $e) {
            return fractal()->item($e)->transformWith(new ExceptionTransformer())->toArray();
        }
    }
}
