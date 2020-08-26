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

    /**
     * 勉強会の詳細取得
     * 
     * @param int $id
     */
    public function view($id);

    /**
     * 勉強会の削除
     * 
     * @param int $id
     */
    public function delete($id);
    
    /**
     * 勉強会新規編集処理
     * 
     * @param $request
     */
    public function edit($id,$request);

    /**
     * 選択されたレコードを取得
     *
     * @return object $result
     */
    public function findByForm($request);

    /**
     * 選択されたレコードを取得
     *
     * @return object $result
     */
    public function searchView($id);
}
