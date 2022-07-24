<?php

namespace Modules\Users\Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserCreateServiceTest extends TestCase
{
    /**
     *@test
     * @return void
     */
    public function should_create_a_user_instance()
    {
        $data = [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => '12Ab@346',
            'confirmPassword' => '12Ab@346'
        ];

        $response = $this->postJson('api/users/create', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('users', [
            'name' => 'John',
            'email'  => 'john@example.com'
        ]);
        DB::statement("TRUNCATE TABLE users;");
    }

    /**
     *@test
     * @return void
     */
    public function should_return_a_401()
    {
        $data = [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => '12Ab@346',
            'confirmPassword' => '12Ab@346'
        ];

        $response = $this->postJson('api/users/create', $data);
        $response = $this->postJson('api/users/create', $data);
        $response->assertStatus(401);

        DB::statement("TRUNCATE TABLE users;");
    }
}
