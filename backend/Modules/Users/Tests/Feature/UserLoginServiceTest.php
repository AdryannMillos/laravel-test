<?php

namespace Modules\Users\Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserLoginServiceTest extends TestCase
{
    /**
     *@test
     * @return void
     */
    public function should_return_a_jwt_token()
    {
        $data = [
            'name' => 'Joohn',
            'email' => 'joohn@example.com',
            'password' => '12Ab@346',
            'confirmPassword' => '12Ab@346'
        ];

        $create = $this->postJson('api/users/create', $data);

        $login = [
            'email' => $data['email'],
            'password' => $data['password']
        ];

        $response = $this->postJson('api/auth/login', $login);

        $response->assertStatus(200);
    }

    /**
     *@test
     * @return void
     */
    public function should_return_a_401()
    {
        $data = [
            'name' => 'Jooohn',
            'email' => 'j00ohn@example.com',
            'password' => '12Ab@346',
            'confirmPassword' => '12Ab@346'
        ];

        $create = $this->postJson('api/users/create', $data);

        $login = [
            'email' => 'Lucas@example.com',
            'password' => $data['password']
        ];

        $response = $this->postJson('api/auth/login', $login);

        $response->assertStatus(401);
    }
}
