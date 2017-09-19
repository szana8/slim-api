<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Eloquent\Admin\GeneralSetting;
use App\Transformers\GeneralSettingTransformer;
use App\Http\Requests\GeneralSetting\AccessRequest;
use App\Http\Requests\GeneralSetting\CreateRequest;
use App\Http\Requests\GeneralSetting\UpdateRequest;
use App\Http\Requests\GeneralSetting\DestroyRequest;
use App\Repositories\Contracts\GeneralSettingsRepository;

class GeneralSettingController extends Controller
{
    /**
     * Base object of the GeneralSetting repository.
     *
     * @var GeneralSetting
     */
    protected $generalSetting;

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
        $settings = $this->generalSetting->search($request->search)->paginate();

        return fractal()->collection($settings)->transformWith(new GeneralSettingTransformer)->toArray();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $setting = $this->generalSetting->find($id);

            return fractal()->item($setting)->transformWith(new GeneralSettingTransformer())->toArray();
        }
        catch (\Exception $e) {
            return fractal()->item($e)->transformWith(new ExceptionTransformer())->toArray();
        }
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
        try {
            $setting = $this->generalSetting->create([
                'name'         => $request->name,
                'display_name' => $request->display_name,
                'description'  => $request->description,
            ]);

            return $this->show($setting->id);
        }
        catch (\Exception $e) {
            return fractal()->item($e)->transformWith(new ExceptionTransformer)->toArray();
        }
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
        try {
            $setting = $this->generalSetting->fill($id, [
                'name'         => $request->name,
                'display_name' => $request->display_name,
                'description'  => $request->description,
            ]);

            return $this->show($setting->id);
        }
        catch (\Exception $e) {
            return fractal()->item($e)->transformWith(new ExceptionTransformer())->toArray();
        }
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
        try {
            $this->generalSetting->delete($id);

            return response(null, 204);
        }
        catch (Exception $e) {
            return fractal()->item($e)->transformWith(new ExceptionTransformer())->toArray();
        }
    }
}
