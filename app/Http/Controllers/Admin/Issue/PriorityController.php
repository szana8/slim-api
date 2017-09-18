<?php

namespace App\Http\Controllers\Admin\Issue;

use App\Http\Controllers\Controller;
use App\Http\Requests\Issue\Priority\AccessRequest;
use App\Http\Requests\Issue\Priority\CreateRequest;
use App\Http\Requests\Issue\Priority\DestroyRequest;
use App\Http\Requests\Issue\Priority\UpdateRequest;
use App\Repositories\Contracts\Issue\PriorityRepository;
use Illuminate\Support\Facades\Auth;

class PriorityController extends Controller
{
    /**
     * Permissions for the create functionality.
     *
     * @var array
     */
    protected $createPermissions = ['create-priority'];

    /**
     * Permissions for the update functionality.
     *
     * @var array
     */
    protected $updatePermissions = ['update-priority'];

    /**
     * Base object of the Priority repository.
     *
     * @var PriorityRepository
     */
    protected $priorityRepository;

    /**
     * PriorityController constructor.
     *
     * @param PriorityRepository $priorityRepository
     */
    public function __construct(PriorityRepository $priorityRepository)
    {
        $this->priorityRepository = $priorityRepository;
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
        return view('admin.issue.priority.index', ['priorities' => $this->priorityRepository->search($request->priority)->paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasPermission($this->createPermissions)) {
            return view('admin.issue.priority.create', ['icons' => \File::allFiles(public_path('img/icons/priorities'))]);
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
        $this->priorityRepository->create($request->toArray());

        return back()->with('message', $request->name.' priority has been successfully created!');
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
            return view('admin.issue.priority.create', ['priority' => $this->priorityRepository->find($id), 'icons' => \File::allFiles(public_path('img/icons/priorities'))]);
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
        $this->priorityRepository->find($id)->update($request->toArray());

        return back()->with('message', $request->name.' priority has been successfully updated!');
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
        $this->priorityRepository->delete($id);

        return back()->with('message', 'The selected priority has been successfully deleted!');
    }
}
