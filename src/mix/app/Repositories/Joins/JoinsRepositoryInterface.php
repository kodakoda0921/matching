<?php
namespace App\Repositories\Joins;

interface JoinsRepositoryInterface
{
    /**
     * 参加承認件数の取得
     * 
     * @return $result
     */
    public function getJoinsCount($meeting_id);
    
    /**
     * 参加承認申請済か確認
     * 
     * @return $result
     */
    public function joinsRequestedConfirm($meeting_id);

    /**
     * 参加申込処理
     * 
     * @return $result
     */
    public function meetJoinRequest($meeting_id);

    /**
     * 参加承認済の一覧取得
     * 
     * @return $result
     */
    public function getJoinedlist($meeting_id);

    /**
     * 未承認件数の取得
     * 
     * @return $result
     */
    public function getUnapprovedCount();
    
    /**
     * 未承認の一覧取得
     * 
     * @return $result
     */
    public function getUnapprovedlist($meeting_id);

    /**
     * 承認済へステータス変更
     * 
     * @return $result
     */
    public function meetingApproval($join_id);
        
    /**
     * 否認へステータス変更
     * 
     * @return $result
     */
    public function meetingUnapproval($join_id);

    /**
     * ログインユーザが参加している勉強会一覧取得
     * 
     * @param int $login_user
     */
    public function getLoginUsersJoinedList($login_user);
}
