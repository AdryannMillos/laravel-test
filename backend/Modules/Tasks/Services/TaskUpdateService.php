<?php

namespace Modules\Tasks\Services;

use Exception;
use Modules\Tasks\Repositories\TaskRepository;

class TaskUpdateService
{
    public function __construct(
        TaskRepository $task_repository
    ) {
        $this->task_repository = $task_repository;
    }

    public function execute(array $data, int $user_id, int $id)
    {
        $findAllTasks = $this->task_repository->getAll($user_id);

        if (!$findAllTasks) {
            throw new Exception('This user has no tasks', 404);
        }

        $task =  $this->task_repository->find($id, 'id');

        if (!$task) {
            throw new Exception('This task does not exist', 404);
        }

        if($task->done == true){
            throw new Exception('This task can not be updated', 401);
        }

        return $this->task_repository->update($data, $user_id, $id);
    }
}
