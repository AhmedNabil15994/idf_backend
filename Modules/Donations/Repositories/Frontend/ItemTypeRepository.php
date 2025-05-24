<?php

namespace Modules\Donations\Repositories\Frontend;

use Modules\Donations\Entities\ItemType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ItemTypeRepository
{
    private $item_type;
    function __construct(ItemType $item_type)
    {
        $this->item_type   = $item_type;
    }

    public function getModel()
    {
        return $this->item_type;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $records = $this->item_type->active()->orderBy($order, $sort)->get();
        return $records;
    }

    public function pluckTitleAndId()
    {
        return pluckModelsCols($this->getAll(),'title','id',true);
    }

    public function findById($id)
    {
        $item_type = $this->item_type->active()->find($id);
        return $item_type;
    }
}
