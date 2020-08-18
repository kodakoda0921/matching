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
}
