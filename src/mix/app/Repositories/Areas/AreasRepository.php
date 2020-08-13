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

    public function getAreasList()
    {
        $result = $this->areas->get();
        return $result;
    }
}
