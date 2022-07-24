<?php


namespace Modules\Tasks\Tests\Unit;

use Exception;
use Mockery;

use Modules\Tasks\Repositories\TaskRepository;
use Modules\Tasks\Entities\Task;
use Modules\Tasks\Services\TaskReadService;
use Tests\TestCase;


class TaskReadServiceTest extends TestCase
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
    public function should_return_a_task_instance()
    {
        $is_admin = 0;

        $user_id = 1;
        $data = [
            [
                "user_id" => 1,
                "description" => "asasdasdb",
                "expiration_date" => "12-12-2022",
                "done" => false,
                "done_date" => "12-12-2022"
            ]
        ];
        $this->task_repository
            ->shouldReceive('getAll')
            ->andReturn(new Task($data));

        $read_task_service = new TaskReadService($this->task_repository);
        $responses = $read_task_service->execute($is_admin, $user_id);

        $this->assertInstanceOf(Task::class, $responses);
        $this->assertEquals(new Task($data), $responses);
    }

    /**
     * @test
     * @return void
     */
    public function should_return_a_task_instance_as_admin()
    {
        $is_admin = 1;

        $user_id = 3;
        $data = [
            [
                "user_id" => 1,
                "description" => "asasdasdb",
                "expiration_date" => "12-12-2022",
                "done" => false,
                "done_date" => "12-12-2022"
            ]
        ];
        $this->task_repository
            ->shouldReceive('getAllAsAdmin')
            ->andReturn(new Task($data));

        $read_task_service = new TaskReadService($this->task_repository);
        $responses = $read_task_service->execute($is_admin, $user_id);

        $this->assertInstanceOf(Task::class, $responses);
        $this->assertEquals(new Task($data), $responses);
    }
}
