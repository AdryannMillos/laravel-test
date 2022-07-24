<?php

namespace Modules\Tasks\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Tasks\Http\Requests\TaskRequest;
use Modules\Tasks\Services\TaskCreateService;

class TaskController extends Controller
{

    public function __construct(
        TaskCreateService $task_create_service
    ) {
        $this->task_create_service = $task_create_service;
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
    public function store(TaskRequest $request)
    {
        try {
            dd($user_id);
            $user_id = Auth::user()->id;
            $validated = $request->validated();
            dd($user_id);
            $this->task_create_service->execute($validated, $user_id);
            return response()->json(['message' => 'Task created successfully!'], 201);
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
