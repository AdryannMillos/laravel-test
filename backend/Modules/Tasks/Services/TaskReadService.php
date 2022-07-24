<?php

namespace Modules\Tasks\Services;

use Exception;
use Modules\Tasks\Repositories\TaskRepository;

class TaskReadService
{
    public function __construct(
        TaskRepository $task_repository
    ) {
        $this->task_repository = $task_repository;
    }

    public function execute(bool $is_admin, int $user_id)
    {
        if($is_admin) {
            return $this->task_repository->getAllAsAdmin();
        }
        return $this->task_repository->getAll($user_id);
    }
}
