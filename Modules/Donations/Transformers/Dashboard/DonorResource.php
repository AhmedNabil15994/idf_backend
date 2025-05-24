<?php

namespace Modules\Donations\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\Resource;
use Modules\User\Transformers\Dashboard\UserResource;

class DonorResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
           'id'            => $this->id,
           'status'         => $this->status,
           'user'        => new UserResource($this->user),
           'user_id'        => optional($this->user)->name,
           'email'        => optional($this->user)->email,
           'phone'        => optional($this->user)->mobile,
           'created_at'    => date('d-m-Y' , strtotime($this->created_at)),
       ];
    }
}
