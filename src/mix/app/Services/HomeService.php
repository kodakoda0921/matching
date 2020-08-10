<?php

namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;

class HomeService
{
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function getLoginUser()
    {
    $result = $this->user->getLoginUser();
        return $result;
    }
}
