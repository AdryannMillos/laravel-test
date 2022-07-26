<?php

namespace Modules\Users\Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TaskCreateServiceTest extends TestCase
{
    /**
     *@test
     * @return void
     */
    public function should_create_a_task_instance()
    {
        $this->withoutMiddleware();
        $data = [
            "description" => "asasdasdb",
            "expiration_date" => "12-12-2022",
            "done" => 0,
            "done_date" => ""
        ];

        $user = [
            "email" => "jooohhn@example.com",
            "password" => "12Ab@346"
        ];

        $token = $this->postJson('api/auth/login', $user);
        $token ='Bearer '. $token->getData();

        $response = $this->postJson('api/tasks/create', $data,  ['Authorization' => $token],);

        $response->assertStatus(201);
    }
}
