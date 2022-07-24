<?php


namespace Modules\Users\Tests\Unit;

use Exception;
use Mockery;

use Modules\Users\Repositories\UserRepository;
use Modules\Users\Entities\User;
use Modules\Users\Services\UserCreateService;
use Tests\TestCase;


class UserCreateServiceTest extends TestCase
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

        $this->user_repository = Mockery::mock(UserRepository::class);
    }

    /**
     * @test
     * @return void
     */
    public function should_return_a_user_instance()
    {
        $data = [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => '12Ab@346',
            'confirmPassword' => '12Ab@346'
        ];

        $this->user_repository
            ->shouldReceive('find')
            ->andReturn();

        $this->user_repository
            ->shouldReceive('store')
            ->andReturn(new User($data));

        $create_user_service = new UserCreateService($this->user_repository);

        $response = $create_user_service->execute($data);

        $this->assertEquals(new User($data), $response);
    }

    /**
     * @test
     * @return void
     */
    public function should_return_a_email_exception()
    {
        $data = [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => '12Ab@346',
            'confirmPassword' => '12Ab@346'
        ];

        $this->user_repository
            ->shouldReceive('find')
            ->andReturn(new User($data));

        $this->user_repository
            ->shouldReceive('store')
            ->andReturn();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Email already in use!');

        $create_user_service = new UserCreateService($this->user_repository);

        $response = $create_user_service->execute($data);
    }

    /**
     * @test
     * @return void
     */
    public function should_return_a_name_exception()
    {
        $data = [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => '12Ab@346',
            'confirmPassword' => '12Ab@346'
        ];

        $this->user_repository
            ->shouldReceive('find')
            ->andReturnValues([false, new User($data)]);

        $this->user_repository
            ->shouldReceive('store')
            ->andReturn();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Name already in use!');

        $create_user_service = new UserCreateService($this->user_repository);

        $response = $create_user_service->execute($data);
    }
}
