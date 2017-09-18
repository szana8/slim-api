<?php

namespace App\Http\Controllers\Admin\Issue;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Issue\CustomField\CreateRequest;
use App\Http\Requests\Issue\CustomField\UpdateRequest;
use App\Http\Requests\Issue\CustomField\DestroyRequest;
use App\Repositories\Contracts\Issue\CustomFieldRepository;

class CustomFieldController extends Controller
{
    /**
     * Base object of the Custom Field repository.
     *
     * @var CustomFieldRepository
     */
    protected $customFieldRepository;

    /**
     * Permissions for the create functionality.
     *
     * @var array
     */
    protected $createPermissions = ['create-custom-field'];

    /**
     * Permissions for the update functionality.
     *
     * @var array
     */
    protected $updatePermissions = ['update-custom-field'];

    /**
     * CustomFieldController constructor.
     *
     * @param CustomFieldRepository $customFieldRepository
     */
    public function __construct(CustomFieldRepository $customFieldRepository)
    {
        $this->customFieldRepository = $customFieldRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.issue.custom_field.index', ['custom_fields' => $this->customFieldRepository->paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasPermission($this->createPermissions)) {
            return view('admin.issue.custom_field.create');
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
        $this->customFieldRepository->create($request->toArray());

        return back()->with('message', $request->name.' custom field has been successfully created!');
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
            return view('admin.issue.custom_field.create', ['custom_field' => $this->customFieldRepository->find($id)]);
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
        $this->customFieldRepository->find($id)->update($request->toArray());

        return back()->with('message', $request->name.' custom field has been successfully updated!');
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
        $this->customFieldRepository->delete($id);

        return back()->with('message', 'The custom field has been successfully deleted!');
    }
}
