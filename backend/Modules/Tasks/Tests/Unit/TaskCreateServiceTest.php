<?php


namespace Modules\Tasks\Tests\Unit;

use Exception;
use Mockery;

use Modules\Tasks\Repositories\TaskRepository;
use Modules\Tasks\Entities\Task;
use Modules\Tasks\Services\TaskCreateService;
use Tests\TestCase;


class TaskCreateServiceTest extends TestCase
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
        $data = [
            "description" => "asasdasdb",
            "expiration_date" => "12-12-2022",
            "done" => false,
            "done_date" => "12-12-2022"
        ];

        $user_id = 1;

        $this->task_repository
            ->shouldReceive('store')
            ->andReturn(new Task($data));

        $create_task_service = new TaskCreateService($this->task_repository);

        $response = $create_task_service->execute($data, $user_id);

        $this->assertEquals(new Task($data), $response);
    }
}
