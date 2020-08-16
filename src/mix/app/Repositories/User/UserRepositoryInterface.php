<?php
namespace App\Repositories\User;

interface UserRepositoryInterface
{
    /**
     *  ログインユーザの取得
     *
     * @return object $result
     */
    public function getLoginUser();
}
