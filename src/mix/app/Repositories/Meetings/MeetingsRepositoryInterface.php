<?php
namespace App\Repositories\Meetings;

interface MeetingsRepositoryInterface
{
    /**
     * 勉強会新規登録処理
     * 
     * @param $request
     * @return $result
     */
    public function regist($request);

    /**
     * ログインユーザ主催の勉強会一覧取得
     * 
     * @param int $login_user
     */
    public function getLoginUsersMeetingList($login_user);
}
