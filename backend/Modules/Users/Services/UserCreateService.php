<?php

namespace Modules\Users\Services;

use Exception;
use Modules\Users\Repositories\UserRepository;

class UserCreateService
{
    public function __construct(
        UserRepository $user_repository
    ) {
        $this->user_repository = $user_repository;
    }

    public function execute(array $data)
    {
        $findEmail = $this->user_repository->find($data['email'], 'email');
        $findName = $this->user_repository->find($data['name'], 'name');

        if ($findEmail) {
            throw new Exception('Email already in use!', 401);
        }
        if ($findName) {
            throw new Exception('Name already in use!', 401);
        }
        if ($data['password'] != $data['confirmPassword']) {
            throw new Exception('Password and confirm password must match', 401);
        }

        $data['password'] = bcrypt($data['password']);

        return $this->user_repository->store($data);
    }
}
