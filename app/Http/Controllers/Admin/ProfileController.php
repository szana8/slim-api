<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use slim\ItemBuilder\ItemBuilder;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ProfileCreateRequest;

class ProfileController extends Controller
{
    /**
     * @var
     */
    protected $item;

    /**
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->item = new ItemBuilder();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $config = config('profile.fields');
        $this->item->make('profile', $config);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProfileCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileCreateRequest $request)
    {
        return true;
        //dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
