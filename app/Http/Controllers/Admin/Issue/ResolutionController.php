<?php

namespace App\Http\Controllers\Admin\Issue;

use App\Http\Controllers\Controller;
use App\Http\Requests\Issue\Resolution\AccessRequest;
use App\Http\Requests\Issue\Resolution\CreateRequest;
use App\Http\Requests\Issue\Resolution\DestroyRequest;
use App\Http\Requests\Issue\Resolution\UpdateRequest;
use App\Repositories\Contracts\Issue\ResolutionRepository;
use Illuminate\Support\Facades\Auth;

class ResolutionController extends Controller
{
    /**
     * Permissions for the create functionality.
     *
     * @var array
     */
    protected $createPermissions = ['create-issue-type-resolution'];

    /**
     * Permissions for the update functionality.
     *
     * @var array
     */
    protected $updatePermissions = ['update-issue-type-resolution'];

    /**
     * @var ResolutionRepository
     */
    protected $resolutionRepository;

    /**
     * ResolutionController constructor.
     *
     * @param ResolutionRepository $resolutionRepository
     */
    public function __construct(ResolutionRepository $resolutionRepository)
    {
        $this->resolutionRepository = $resolutionRepository;
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
        return view('admin.issue.resolution.index', ['resolutions' => $this->resolutionRepository->search($request->resolution)->paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasPermission($this->createPermissions)) {
            return view('admin.issue.resolution.create');
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
        $this->resolutionRepository->create($request->toArray());

        return back()->with('message', $request->name.' issue resolution has been successfully created!');
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
            return view('admin.issue.resolution.create', ['resolution' => $this->resolutionRepository->find($id)]);
        }

        throw new AccessDeniedHttpException('This action is unauthorized!');
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
        $this->resolutionRepository->find($id)->update($request->toArray());

        return back()->with('message', $request->name.' issue resolution has been successfully updated!');
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
        $this->resolutionRepository->delete($id);

        return back()->with('message', 'The selected resolution has been successfully deleted!');
    }
}
