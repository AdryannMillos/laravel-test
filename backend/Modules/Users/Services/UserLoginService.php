<?php

namespace Modules\Users\Services;

use Exception;
use Modules\Users\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserLoginService
{
    public function __construct(
        UserRepository $user_repository
    ) {
        $this->user_repository = $user_repository;
    }

    public function execute(array $data)
    {
        $findEmail = $this->user_repository->find($data['email'], 'email');

        if (!$findEmail) {
            throw new Exception('Email or Password not Found!', 401);
        }

        $findPassword = Hash::check($data['password'], $findEmail->password);

        if (!$findPassword) {
            throw new Exception('Email or Password not Found!', 401);
        }

        return auth()->login($findEmail);
    }
}
