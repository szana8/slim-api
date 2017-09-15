<?php

namespace App\Http\Controllers\Admin\Issue;

use App\Http\Requests\Issue\Status\AccessRequest;
use App\Http\Requests\Issue\Status\CreateRequest;
use App\Http\Requests\Issue\Status\DestroyRequest;
use App\Http\Requests\Issue\Status\UpdateRequest;
use App\Repositories\Contracts\Issue\StatusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    /**
     * Permissions for the create functionality.
     *
     * @var array
     */
    protected $createPermissions = ['create-issue-status'];

    /**
     * Permissions for the update functionality.
     *
     * @var array
     */
    protected $updatePermissions = ['update-issue-status'];

    /**
     * @var StatusRepository
     */
    protected $issueStatusRepository;

    /**
     * IssueStatusController constructor.
     * @param StatusRepository $issueStatusRepository
     */
    public function __construct(StatusRepository $issueStatusRepository)
    {
        $this->issueStatusRepository = $issueStatusRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param AccessRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(AccessRequest $request)
    {
        return view('admin.issue.status.index', ['statuses' => $this->issueStatusRepository->search($request->status)->paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasPermission($this->createPermissions)) {
            return view('admin.issue.status.create');
        }

        throw new AccessDeniedHttpException('This action is unauthorized!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $this->issueStatusRepository->create($request->toArray());

        return back()->with('message', $request->name.' issue status has been successfully created!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->hasPermission($this->updatePermissions)) {
            return view('admin.issue.status.create', ['status' => $this->issueStatusRepository->find($id)]);
        }

        throw new AccessDeniedHttpException('This action is unauthorized!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->issueStatusRepository->find($id)->update($request->toArray());

        return back()->with('message', $request->name.' issue status has been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyRequest $request, $id)
    {
        $this->issueStatusRepository->delete($id);

        return back()->with('message', 'The selected status has been successfully deleted!');
    }
}
