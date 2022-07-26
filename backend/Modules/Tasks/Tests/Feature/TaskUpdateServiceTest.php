<?php

namespace Modules\Users\Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TaskUpdateServiceTest extends TestCase
{
    /**
     *@test
     * @return void
     */
    public function should_update_a_task_instance()
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

        $response = $this->putJson('api/tasks/1/update', $data,  ['Authorization' => $token],);

        $response->assertStatus(200);
    }
}
