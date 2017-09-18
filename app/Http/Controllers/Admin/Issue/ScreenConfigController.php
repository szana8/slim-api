<?php

namespace App\Http\Controllers\Admin\Issue;

use App\Http\Controllers\Controller;
use App\Http\Requests\Issue\ScreenConfig\CreateRequest;
use App\Repositories\Contracts\Issue\CustomFieldRepository;
use App\Repositories\Contracts\Issue\ScreenConfigRepository;
use App\Repositories\Eloquent\Criteria\EagerLoad;

class ScreenConfigController extends Controller
{
    /**
     * @var CustomFieldRepository
     */
    private $customFieldRepository;
    /**
     * @var ScreenConfigRepository
     */
    private $screenConfigRepository;

    /**
     * ScreenConfigController constructor.
     *
     * @param CustomFieldRepository  $customFieldRepository
     * @param ScreenConfigRepository $screenConfigRepository
     */
    public function __construct(CustomFieldRepository $customFieldRepository, ScreenConfigRepository $screenConfigRepository)
    {
        $this->customFieldRepository = $customFieldRepository;
        $this->screenConfigRepository = $screenConfigRepository;
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
        $this->screenConfigRepository->create($request->toArray());

        return back()->with('message', 'Screen config has been successfully created!');
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
        $screenFields = $this->screenConfigRepository->withCriteria([
            new EagerLoad(['fields']),
        ])->findWhere('issue_screen_id', $id)->get();

        return view('admin.issue.screenconfig.config', ['fields' => $this->customFieldRepository->findWhereNotIn('id', $screenFields->pluck('custom_field_id')->toArray()), 'screen' => $id, 'screenFields' => $screenFields]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $this->screenConfigRepository->find(request()->custom_field_id)->delete();

        return back()->with('message', 'The selected screen config has been successfully deleted!');
    }
}
