<?php

namespace Modules\Catalog\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\Resource;

class PartnerResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'link' => $this->link,
            'status' => $this->status,
            'image' => $this->getFirstMediaUrl('images'),
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
        ];
    }
}
