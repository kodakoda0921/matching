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
}
