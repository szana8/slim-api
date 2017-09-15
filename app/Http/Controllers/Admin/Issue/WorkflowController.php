<?php

namespace App\Http\Controllers\Admin\Issue;

use App\Http\Requests\Issue\Workflow\CreateRequest;
use App\Http\Requests\Issue\Workflow\UpdateRequest;
use App\Repositories\Contracts\Issue\WorkflowRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WorkflowController extends Controller
{
    /**
     * Permissions for the create functionality.
     *
     * @var array
     */
    protected $createPermissions = ['create-workflow'];

    /**
     * Permissions for the update functionality.
     *
     * @var array
     */
    protected $updatePermissions = ['update-workflow'];

    /**
     * @var WorkflowRepository
     */
    private $workflowRepository;

    /**
     * WorkflowController constructor.
     * @param WorkflowRepository $workflowRepository
     */
    public function __construct(WorkflowRepository $workflowRepository)
    {
        $this->workflowRepository = $workflowRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.issue.workflow.index', ['workflows' => $this->workflowRepository->paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.issue.workflow.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $this->workflowRepository->create($request->toArray());

        return back()->with('message', $request->name.' workflow has been successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            return view('admin.issue.workflow.create', ['workflow' => $this->workflowRepository->find($id)]);
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
        $this->workflowRepository->find($id)->update($request->toArray());

        return back()->with('message', $request->name . ' workflow type has been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
