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
        $task->done_date = '0asd';

        $task->save();
    }

    public function getAllAsAdmin()
    {
            return Task::all();
    }

    public function getAll(int $user_id)
    {
        return Task::all()->where('user_id', $user_id);
    }
}
