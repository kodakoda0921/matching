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

    /**
     *  ユーザの取得
     * @param int $id
     * @return object $result
     */
    public function getUser($id);
}
