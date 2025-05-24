<?php

namespace Modules\Donations\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\Resource;

class DonateResourceResource extends Resource
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
           'name'         => $this->name,
           'phone'        => $this->phone,
           'modal'        => view('donations::dashboard.donate-resources.show-modal',['record' => $this])->render(),
           'deleted_at'    => $this->deleted_at,
           'created_at'    => date('d-m-Y' , strtotime($this->created_at)),
       ];
    }
}
