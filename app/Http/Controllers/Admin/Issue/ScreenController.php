<?php

namespace App\Http\Controllers\Admin\Issue;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Issue\Screen\AccessRequest;
use App\Http\Requests\Issue\Screen\CreateRequest;
use App\Http\Requests\Issue\Screen\UpdateRequest;
use App\Http\Requests\Issue\Screen\DestroyRequest;
use App\Repositories\Contracts\Issue\ScreenRepository;

class ScreenController extends Controller
{
    /**
     * Permissions for the create functionality.
     *
     * @var array
     */
    protected $createPermissions = ['create-screen'];

    /**
     * Permissions for the update functionality.
     *
     * @var array
     */
    protected $updatePermissions = ['update-screen'];

    /**
     * @var ScreenRepository
     */
    protected $screenRepository;

    /**
     * ScreenController constructor.
     *
     * @param ScreenRepository $screenRepository
     */
    public function __construct(ScreenRepository $screenRepository)
    {
        $this->screenRepository = $screenRepository;
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
        return view('admin.issue.screen.index', ['screens' => $this->screenRepository->search($request->screen)->paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasPermission($this->createPermissions)) {
            return view('admin.issue.screen.create');
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
        $this->screenRepository->create($request->toArray());

        return back()->with('message', $request->name.' screen has been successfully created!');
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
            return view('admin.issue.screen.create', ['screen' => $this->screenRepository->find($id)]);
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
        $this->screenRepository->find($id)->update($request->toArray());

        return back()->with('message', $request->name.' screen has been successfully updated!');
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
        $this->screenRepository->delete($id);

        return back()->with('message', 'The selected screen has been successfully deleted!');
    }
}
