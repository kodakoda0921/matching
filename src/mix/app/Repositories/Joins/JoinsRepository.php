<?php
namespace App\Repositories\Joins;

use App\Repositories\Joins\JoinsRepositoryInterface;
use App\Models\Joins;

class JoinsRepository implements JoinsRepositoryInterface
{
    public function __construct(Joins $joins)
    {
        $this->joins = $joins;
    }

    /**
     * 参加承認済件数の取得
     * 
     * @return $result
     */
    public function getJoinsCount($meeting_id)
    {
        $result = $this->joins->where('meeting_id', '=', $meeting_id)->where('approval', '=', 1)->count();
        return $result;
    }
}
