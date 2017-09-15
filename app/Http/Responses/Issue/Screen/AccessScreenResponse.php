<?php
namespace App\Http\Responses\Issue\Screen;

use Illuminate\Contracts\Support\Responsable;

class AccessScreenResponse implements Responsable
{

    /**
     * @var
     */
    protected $screenRepository;

    /**
     * StoreRoleResponse constructor.
     * @param $screenRepository
     */
    public function __construct($screenRepository)
    {
        $this->screenRepository = $screenRepository;
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        if ($request->wantsJson())
            return $this->apiResponse($request);

        return $this->webResponse($request);
    }

    /**
     * Return the role response for the web routes.
     *
     * @param $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function webResponse($request)
    {
        return view('admin.issue.screen.index', ['screen' => $this->screenRepository]);
    }

    /**
     * Return the role response for the api routes.
     *
     * @param $request
     * @return $this
     * @throws \InvalidArgumentException
     */
    protected function apiResponse($request)
    {
        return response()->json($this->screenRepository)->setStatusCode(201);
    }
}