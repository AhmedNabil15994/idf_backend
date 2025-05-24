<?php

namespace Modules\Catalog\Repositories\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Catalog\Entities\HomeCard;
use Modules\Catalog\Entities\Partner;
use Modules\Catalog\Entities\Statistics;
use Modules\Charities\Entities\Charity;
use Modules\User\Entities\User;
use Modules\User\Repositories\Dashboard\UserRepository;

class HomeCardRepository
{
    private $model;

    function __construct(HomeCard $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $records = $this->model->active()->orderBy($order, $sort)->get();
        return $records;
    }

    public function take( $take = 6,$order = 'id', $sort = 'desc')
    {
        $records = $this->model->active()->orderBy($order, $sort)->take($take)->get();
        return $records;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $records = $this->model->active()->orderBy($order, $sort)->get();
        return $records;
    }

    public function getPagination($order = 'id', $sort = 'desc' , $pagination = 10)
    {
        $records = $this->model->active()->orderBy($order, $sort)->paginate($pagination);
        return $records;
    }

    public function findById($id)
    {
        $model = $this->model->active()->find($id);
        return $model;
    }
}
