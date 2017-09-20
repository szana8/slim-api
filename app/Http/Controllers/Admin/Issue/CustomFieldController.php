<?php

namespace App\Http\Controllers\Admin\Issue;

use App\Http\Controllers\Controller;
use App\Http\Requests\Issue\CustomField\AccessRequest;
use App\Transformers\ExceptionTransformer;
use App\Transformers\Issue\CustomFieldTransformer;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Issue\CustomField\CreateRequest;
use App\Http\Requests\Issue\CustomField\UpdateRequest;
use App\Http\Requests\Issue\CustomField\DestroyRequest;
use App\Repositories\Contracts\Issue\CustomFieldRepository;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class CustomFieldController extends Controller
{
    /**
     * Base object of the Custom Field repository.
     *
     * @var CustomFieldRepository
     */
    protected $customFieldRepository;

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
     * @param AccessRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(AccessRequest $request)
    {
        $field = $this->customFieldRepository->search($request->search)->paginate();

        return fractal()->collection($field, new CustomFieldTransformer)
            ->paginateWith(new IlluminatePaginatorAdapter($field))
            ->toArray();
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
            $customField = $this->customFieldRepository->create([
                'name' => $request->name,
                'description' => $request->description,
                'type' => $request->type,
                'api' => $request->api,
                'protected' => $request->protected
            ])->syncPermissions($request->permissions);

            return $this->show($customField->id);
        } catch (\Exception $e) {
            return fractal()->item($e, new ExceptionTransformer())->toArray();
        }
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
            $customField = $this->customFieldRepository->find($id);

            return fractal()->item($customField, new CustomFieldTransformer())->toArray();
        } catch (\Exception $e) {
            return fractal()->item($e, new ExceptionTransformer())->toArray();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $customField = $this->customFieldRepository->fill($id, [
                'name' => $request->name,
                'description' => $request->description,
                'type' => $request->type,
                'api' => $request->api,
                'protected' => $request->protected
            ])->syncPermissions($request->permissions);

            return $this->show($customField->id);
        }
        catch (\Exception $e) {
            return fractal()->item($e, new ExceptionTransformer())->toArray();
        }
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
        try {
            $this->customFieldRepository->delete($id);

            return response(null, 204);
        } catch (\Exception $e) {
            return fractal()->item($e, new ExceptionTransformer())->toArray();
        }
    }
}
