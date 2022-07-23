<?php

namespace Modules\Users\Repositories;

use Modules\Users\Entities\User;

class UserRepository
{
    public function find(string $info, string $field)
    {
        return User::where($field, $info)->first();
    }
    public function store($data)
    {
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];

        $user->save();
    }
}
