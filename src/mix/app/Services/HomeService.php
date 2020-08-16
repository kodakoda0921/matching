<?php

namespace App\Services;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Log;

class HomeService
{
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    /**
     *  ログインユーザの取得
     *
     * @return object $result
     */
    public function getLoginUser()
    {
    Log::debug("START");
    $result = $this->user->getLoginUser();
    Log::debug("END");
        return $result;
    }
}
