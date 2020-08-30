<?php

namespace App\Repositories\User;

use App\Repositories\User\UserRepositoryInterface;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
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
        $user = Auth::user();
        $result = $this->user->find($user->id);
        return $result;
    }

    /**
     *  ユーザの取得
     * @param int $id
     * @return object $result
     */
    public function getUser($id)
    {
        $result = $this->user->find($id);
        return $result;
    }
}
