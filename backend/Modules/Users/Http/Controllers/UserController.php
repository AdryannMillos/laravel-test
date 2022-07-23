<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Throwable;
use Illuminate\Http\Request;
use Modules\Users\Http\Requests\UserRequest;
use Modules\Users\Services\UserCreateService;

class UserController extends Controller
{

    public function __construct(
        UserCreateService $user_create_service
    ) {
        $this->user_create_service = $user_create_service;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {
            $validated = $request->validated();
            $this->user_create_service->execute($validated);
            return response()->json(['message' => 'User created successfully!'], 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
