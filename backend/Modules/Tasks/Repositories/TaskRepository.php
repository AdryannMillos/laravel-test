<?php

namespace Modules\Tasks\Repositories;

use Modules\Tasks\Entities\Task;

class TaskRepository
{
    public function store(array $data, int $user_id)
    {
        $task = new Task;
        $task->user_id = $user_id;
        $task->description = $data['description'];
        $task->expiration_date = $data['expiration_date'];
        $task->done = $data['done'];
        $task->done_date = $data['done_date'];

        $task->save();
    }

    public function getAllAsAdmin()
    {
        $tasks = Task::with('user')->paginate(5);
        return $tasks;
    }

    public function getAll(int $user_id)
    {
        return ['data'=>Task::all()->where('user_id', $user_id)];
    }

    public function update(array $data, int $user_id, int $id)
    {
        return Task::where('user_id', $user_id)
            ->where('id', $id)
            ->update($data);
    }

    public function find(string $info, string $field)
    {
        return Task::where($field, $info)->first();
    }
}
