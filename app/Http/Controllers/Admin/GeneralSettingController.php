<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Eloquent\Admin\GeneralSetting;
use App\Repositories\Contracts\GeneralSettingsRepository;
use App\Http\Requests\GeneralSetting\AccessRequest;
use App\Http\Requests\GeneralSetting\CreateRequest;
use App\Http\Requests\GeneralSetting\UpdateRequest;
use App\Http\Requests\GeneralSetting\DestroyRequest;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class GeneralSettingController extends Controller
{
    /**
     * Base object of the GeneralSetting repository.
     *
     * @var GeneralSetting
     */
    protected $generalSetting;

    /**
     * Permissions for the create functionality.
     *
     * @var array
     */
    protected $createPermissions = ['create-setting'];

    /**
     * Permissions for the update functionality.
     *
     * @var array
     */
    protected $updatePermissions = ['update-setting'];

    /**
     * GeneralSettingsController constructor.
     *
     * @param GeneralSettingsRepository $generalSettingsRepository
     */
    public function __construct(GeneralSettingsRepository $generalSettingsRepository)
    {
        $this->generalSetting = $generalSettingsRepository;
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
        return view('admin.general_setting.index', ['settings' => $this->generalSetting->search($request->searchSetting)->paginate()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasPermission($this->createPermissions)) {
            return view('admin.general_setting.create');
        }

        throw new AccessDeniedHttpException('This action is unauthorized!');
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
            return view('admin.general_setting.create', ['general_setting' => $this->generalSetting->find($id)]);
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
        $this->generalSetting->create($request->toArray());

        return back()->with('message', $request->name.' general setting has been successfully created!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param int                         $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $this->generalSetting->find($id)->update($request->toArray());

        return back()->with('message', $request->name.' general setting has been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyRequest $request, $id)
    {
        $this->generalSetting->find($id)->delete();

        return back()->with('message', 'The selected general setting has been successfully deleted!');
    }
}
