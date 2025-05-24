<?php

namespace Modules\Catalog\Repositories\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Catalog\Entities\Partner;
use Modules\Charities\Entities\Charity;
use Modules\User\Entities\User;
use Modules\User\Repositories\Dashboard\UserRepository;

class PartnerRepository
{
    private $model;

    function __construct(Partner $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $nationalities = $this->model->active()->orderBy($order, $sort)->get();
        return $nationalities;
    }

    public function take( $take = 6,$order = 'id', $sort = 'desc')
    {
        return $this->model->active()->orderBy($order, $sort)->take($take)->get();
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        return $this->model->active()->orderBy($order, $sort)->get();
    }

    public function getPagination($order = 'id', $sort = 'desc' , $pagination = 10)
    {
        return $this->model->active()->orderBy($order, $sort)->paginate($pagination);
    }

    public function findById($id)
    {
        $model = $this->model->active()->find($id);
        return $model;
    }
}
