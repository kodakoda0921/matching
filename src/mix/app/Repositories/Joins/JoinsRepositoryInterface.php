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
}
