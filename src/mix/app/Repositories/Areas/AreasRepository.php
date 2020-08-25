<?php
namespace App\Repositories\Areas;

use App\Repositories\Areas\AreasRepositoryInterface;
use App\Models\Areas;

class AreasRepository implements AreasRepositoryInterface
{
    public function __construct(Areas $areas)
    {
        $this->areas = $areas;
    }

    /**
     * 所在地リストの取得
     * 
     * @return $result
     */
    public function getAreasList()
    {
        $result = $this->areas->get();
        return $result;
    }

    /**
     * 所在地リストの取得
     * 
     * @return $result
     */
    public function view($area_id)
    {
        $result = $this->areas->find($area_id);
        return $result;
    }
}
