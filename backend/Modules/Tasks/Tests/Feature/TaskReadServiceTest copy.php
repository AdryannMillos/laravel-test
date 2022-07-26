<?php

namespace Modules\Users\Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TaskReadServiceTest extends TestCase
{
    /**
     *@test
     * @return void
     */
    public function should_get_all_tasks_instance()
    {
        $this->withoutMiddleware();
        $data = [
            "description" => "asasdasdb",
            "expiration_date" => "12-12-2022",
            "done" => 0,
            "done_date" => ""
        ];

        $user = [
            "email" => "joohn@example.com",
            "password" => "12Ab@346"
        ];

        $token = $this->postJson('api/auth/login', $user);
        $token ='Bearer '. $token->getData();

        $response = $this->getJson('api/tasks', $data,  ['Authorization' => $token],);

        $response->assertStatus(200);
    }
}
