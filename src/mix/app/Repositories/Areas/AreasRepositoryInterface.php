<?php
namespace App\Repositories\Areas;

interface AreasRepositoryInterface
{
     /**
     * 所在地リストの取得
     * 
     * @return $result
     */
    public function getAreasList();

    /**
     * 所在地リストの取得
     * 
     * @return $result
     */
    public function view($area_id);
}
