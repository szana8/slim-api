<?php

namespace App\Http\Controllers\Admin\Issue;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Issue\Type\AccessRequest;
use App\Http\Requests\Issue\Type\CreateRequest;
use App\Http\Requests\Issue\Type\UpdateRequest;
use App\Http\Requests\Issue\Type\DestroyRequest;
use App\Repositories\Contracts\Issue\TypeRepository;

class TypeController extends Controller
{
    /**
     * Permissions for the create functionality.
     *
     * @var array
     */
    protected $createPermissions = ['create-issue-type'];

    /**
     * Permissions for the update functionality.
     *
     * @var array
     */
    protected $updatePermissions = ['update-issue-type'];

    /**
     * @var TypeRepository
     */
    protected $issueTypeRepository;

    /**
     * IssueTypeController constructor.
     *
     * @param TypeRepository $issueTypeRepository
     */
    public function __construct(TypeRepository $issueTypeRepository)
    {
        $this->issueTypeRepository = $issueTypeRepository;
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
        $issueType = $this->issueTypeRepository->search($request->search)->paginate();

        return view('admin.issue.type.index', ['issueTypes' => $issueType]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasPermission($this->createPermissions)) {
            return view('admin.issue.type.create', ['icons' => \File::allFiles(public_path('img/icons/issuetypes'))]);
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
        $this->issueTypeRepository->create($request->toArray());

        return back()->with('message', $request->name.' issue type has been successfully created!');
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
            return view('admin.issue.type.create', ['issueType' => $this->issueTypeRepository->find($id),
                'icons'                                         => \File::allFiles(public_path('img/icons')), ]);
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
        $this->issueTypeRepository->find($id)->update($request->toArray());

        return back()->with('message', $request->name.' issue type has been successfully updated!');
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
        $this->issueTypeRepository->delete($id);

        return back()->with('message', 'The selected type has been successfully deleted!');
    }
}
