<?php

namespace App\Http\Controllers\Admin\Issue;

use App\Http\Controllers\Controller;
use App\Http\Requests\Issue\TypeSchema\AccessRequest;
use App\Http\Requests\Issue\TypeSchema\CreateRequest;
use App\Http\Requests\Issue\TypeSchema\DestroyRequest;
use App\Http\Requests\Issue\TypeSchema\UpdateRequest;
use App\Repositories\Contracts\Issue\TypeRepository;
use App\Repositories\Contracts\Issue\TypeSchemeRepository;
use App\Repositories\Eloquent\Criteria\EagerLoad;
use Illuminate\Support\Facades\Auth;

class TypeSchemaController extends Controller
{
    /**
     * Permissions for the create functionality.
     *
     * @var array
     */
    protected $createPermissions = ['create-issue-type-schema'];

    /**
     * Permissions for the update functionality.
     *
     * @var array
     */
    protected $updatePermissions = ['update-issue-type-schema'];

    /**
     * @var TypeSchemeRepository
     */
    protected $issueTypeSchemeRepository;

    /**
     * @var TypeRepository
     */
    protected $issueTypeRepository;

    /**
     * IssueTypeSchemaController constructor.
     *
     * @param TypeSchemeRepository $issueTypeSchemeRepository
     * @param TypeRepository       $issueTypeRepository
     */
    public function __construct(TypeSchemeRepository $issueTypeSchemeRepository, TypeRepository $issueTypeRepository)
    {
        $this->issueTypeSchemeRepository = $issueTypeSchemeRepository;
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
        $issueTypeScheme = $this->issueTypeSchemeRepository->withCriteria([
            new EagerLoad(['issueTypes', 'defaultIssueType']),
        ])->search($request->searchIssueTypeSchema)->paginate();

        return view('admin.issue.type_schema.index', ['issue_type_scheme' => $issueTypeScheme]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasPermission($this->createPermissions)) {
            return view('admin.issue.type_schema.create', ['issue_types' => $this->issueTypeRepository->all()]);
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
        $this->issueTypeSchemeRepository->create($request->toArray())->syncIssueTypes($request->issueTypes);

        return back()->with('message', $request->name.' issue type scheme has been successfully created!');
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
            return view('admin.issue.type_schema.create', ['issueTypeScheme' => $this->issueTypeSchemeRepository->find($id), 'issue_types' => $this->issueTypeRepository->all()]);
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
        $this->issueTypeSchemeRepository->find($id)->update($request->toArray());
        $this->issueTypeSchemeRepository->find($id)->syncIssueTypes($request->issueTypes);

        return back()->with('message', $request->name.' issue type scheme has been successfully updated!');
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
        $this->issueTypeSchemeRepository->delete($id);

        return back()->with('message', 'The selected issue type schema has been successfully deleted!');
    }
}
