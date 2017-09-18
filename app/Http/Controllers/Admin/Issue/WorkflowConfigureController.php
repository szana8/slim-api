<?php

namespace App\Http\Controllers\Admin\Issue;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Issue\StatusRepository;
use App\Repositories\Contracts\Issue\WorkflowRepository;

class WorkflowConfigureController extends Controller
{
    /**
     * @var WorkflowRepository
     */
    private $workflowRepository;
    /**
     * @var StatusRepository
     */
    private $statusRepository;

    /**
     * WorkflowConfigureController constructor.
     *
     * @param WorkflowRepository $workflowRepository
     * @param StatusRepository   $statusRepository
     */
    public function __construct(WorkflowRepository $workflowRepository, StatusRepository $statusRepository)
    {
        $this->workflowRepository = $workflowRepository;
        $this->statusRepository = $statusRepository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('admin.issue.workflow_config.config', [
            'workflow'   => $this->workflowRepository->find($id)->descriptor,
            'statuses'   => $this->statusRepository->all()->toJson(),
            'workflowId' => $id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->workflowRepository->find($id)->update($request->toArray());

        return back()->with('message', 'Workflow has been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
