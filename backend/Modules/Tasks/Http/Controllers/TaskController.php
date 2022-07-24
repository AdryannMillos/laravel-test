<?php

namespace Modules\Tasks\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Tasks\Http\Requests\TaskRequest;
use Modules\Tasks\Services\TaskCreateService;
use Modules\Tasks\Services\TaskReadService;
use Modules\Tasks\Services\TaskUpdateService;

class TaskController extends Controller
{

    public function __construct(
        TaskCreateService $task_create_service,
        TaskReadService $task_read_service,
        TaskUpdateService $task_update_service
    ) {
        $this->task_create_service = $task_create_service;
        $this->task_read_service = $task_read_service;
        $this->task_update_service = $task_update_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $user_id = Auth::user()->id;
            $is_admin = Auth::user()->is_admin;
            $tasks = $this->task_read_service->execute($is_admin, $user_id);
            return response()->json($tasks, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
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
            $user_id = Auth::user()->id;
            $validated = $request->validated();
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
    public function update(TaskRequest $request)
    {
        try {
            $user_id = Auth::user()->id;
            $validated = $request->validated();
            $this->task_update_service->execute($validated, $user_id, $request->id);
            return response()->json(['message' => 'Task updated successfully!'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
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
