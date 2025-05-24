<?php

namespace Modules\Donations\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\Resource;

class DonationStatusResource extends Resource
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
           'code'         => $this->code,
           'title'        => $this->translate(locale())->title,
       ];
    }
}
