<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\AccessRequest;
use App\Http\Requests\Team\CreateRequest;
use App\Http\Requests\Team\UpdateRequest;
use App\Http\Requests\Team\DestroyRequest;
use App\Transformers\ExceptionTransformer;
use App\Repositories\Contracts\TeamRepository;
use App\Transformers\Authorization\TeamTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class TeamController extends Controller
{
    /**
     * Base object of the Team repository.
     *
     * @var TeamRepository
     */
    protected $team;

    /**
     * TeamController constructor.
     *
     * @param TeamRepository       $team
     */
    public function __construct(TeamRepository $team)
    {
        $this->team = $team;
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
        $teams = $this->team->search($request->search)->get();

        return fractal()->collection($teams, new TeamTransformer())
                        ->includeRoles()
                        //->paginateWith(new IlluminatePaginatorAdapter($teams))
                        ->toArray();
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
            $team = $this->team->create([
                'name'         => $request->name,
                'display_name' => $request->display_name,
                'description'  => $request->description,
            ]);

            return $this->show($team->id);
        } catch (\Exception $e) {
            return fractal()->item($e)->transformWith(new ExceptionTransformer())->toArray();
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
            $team = $this->team->find($id);

            return fractal()->item($team)->transformWith(new TeamTransformer())->includePermissions()->toArray();
        } catch (\Exception $e) {
            return fractal()->item($e)->transformWith(new ExceptionTransformer())->toArray();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param int           $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $team = $this->team->fill($id, [
                'name'         => $request->name,
                'display_name' => $request->display_name,
                'description'  => $request->description,
            ]);

            return $this->show($team->id);
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
            $this->team->delete($id);

            return response(null, 204);
        } catch (\Exception $e) {
            return fractal()->item($e)->transformWith(new ExceptionTransformer())->toArray();
        }
    }
}
