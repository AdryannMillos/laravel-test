<?php


namespace Modules\Tasks\Tests\Unit;

use Exception;
use Mockery;

use Modules\Tasks\Repositories\TaskRepository;
use Modules\Tasks\Entities\Task;
use Modules\Tasks\Services\TaskUpdateService;
use Tests\TestCase;


class TaskUpdateServiceTest extends TestCase
{
    protected $tenancy = true;

    public function tearDown(): void
    {
        parent::tearDown();

        Mockery::close();
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->task_repository = Mockery::mock(TaskRepository::class);
    }

    /**
     * @test
     * @return void
     */
    public function should_return_a_update_task_instance()
    {
        $data = [
            "description" => "abc",
            "expiration_date" => "12-12-2022",
            "done" => false,
            "done_date" => "12-12-2022"
        ];

        $user_id = 1;
        $this->task_repository
            ->shouldReceive('getAll')
            ->andReturn(new Task($data));

        $this->task_repository
            ->shouldReceive('find')
            ->andReturn(new Task($data));

        $this->task_repository
            ->shouldReceive('update')
            ->andReturn(new Task($data));

        $update_task_service = new TaskUpdateService($this->task_repository);

        $response = $update_task_service->execute($data, $user_id, 1);

        $this->assertEquals(new Task($data), $response);
    }

    /**
     * @test
     * @return void
     */
    public function should_return_a_no_tasks_exception()
    {
        $data = [
            "description" => "abc",
            "expiration_date" => "12-12-2022",
            "done" => false,
            "done_date" => "12-12-2022"
        ];

        $user_id = 1;
        $this->task_repository
            ->shouldReceive('getAll')
            ->andReturn();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('This user has no tasks');

        $update_task_service = new TaskUpdateService($this->task_repository);

        $response = $update_task_service->execute($data, $user_id, 1);

        $this->assertEquals(new Task($data), $response);
    }

    /**
     * @test
     * @return void
     */
    public function should_return_a_task_not_found()
    {
        $data = [
            "description" => "abc",
            "expiration_date" => "12-12-2022",
            "done" => false,
            "done_date" => "12-12-2022"
        ];

        $user_id = 1;
        $this->task_repository
            ->shouldReceive('getAll')
            ->andReturn(new Task($data));

        $this->task_repository
            ->shouldReceive('find')
            ->andReturn();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('This task does not exist');

        $update_task_service = new TaskUpdateService($this->task_repository);

        $response = $update_task_service->execute($data, $user_id, 2);

        $this->assertEquals(new Task($data), $response);
    }
}
