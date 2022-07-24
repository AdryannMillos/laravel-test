<?php


namespace Modules\Users\Tests\Unit;

use Exception;
use Mockery;

use Modules\Users\Repositories\UserRepository;
use Modules\Users\Entities\User;
use Modules\Users\Services\UserloginService;
use Tests\TestCase;


class UserLoginServiceTest extends TestCase
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
            'email' => 'john@example.com',
            'password' => '12Ab@346',
        ];

        $data['password'] = bcrypt($data['password']);

        $this->user_repository
            ->shouldReceive('find')
            ->andReturn(new User([
                'email' => 'john@example.com',
                'password' => bcrypt($data['password']),
            ]));

        $create_user_service = new UserloginService($this->user_repository);

        $response = $create_user_service->execute($data);

        $this->assertEquals(300, strlen($response));
    }

    /**
     * @test
     * @return void
     */
    public function should_return_a_email_exception()
    {
        $data = [
            'email' => 'john@example.com',
            'password' => '12Ab@346',
        ];

        $data['password'] = bcrypt($data['password']);

        $this->user_repository
            ->shouldReceive('find')
            ->andReturn();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Email or Password not Found!');

        $create_user_service = new UserloginService($this->user_repository);

        $response = $create_user_service->execute($data);

        $this->assertEquals(300, strlen($response));
    }

    /**
     * @test
     * @return void
     */
    public function should_return_a_password_exception()
    {
        $data = [
            'email' => 'john@example.com',
            'password' => '12Ab@346',
        ];

        $data['password'] = bcrypt($data['password']);

        $this->user_repository
            ->shouldReceive('find')
            ->andReturn(new User([
                'email' => 'john@example.com',
                'password' => bcrypt('pass'),
            ]));

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Email or Password not Found!');

        $create_user_service = new UserloginService($this->user_repository);

        $response = $create_user_service->execute($data);

        $this->assertEquals(300, strlen($response));
    }
}
