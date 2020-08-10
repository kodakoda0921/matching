<?php

namespace App\Repositories\UserProfile;

interface UserProfileRepositoryInterface
{
    /**
     * 選択されたレコードを取得
     *
     * @return object
     */
    public function findByForm($request);
}
