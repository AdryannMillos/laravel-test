<?php

namespace Modules\Tasks\Services;

use Exception;
use Modules\Tasks\Repositories\TaskRepository;

class TaskCreateService
{
    public function __construct(
        TaskRepository $task_repository
    ) {
        $this->task_repository = $task_repository;
    }

    public function execute(array $data, int $user_id)
    {
        return $this->task_repository->store($data, $user_id);
    }
}
