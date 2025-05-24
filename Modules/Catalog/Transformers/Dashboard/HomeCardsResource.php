<?php

namespace Modules\Catalog\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\Resource;

class HomeCardsResource extends Resource
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
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'status' => $this->status,
            'color' => $this->color,
            'link' => $this->link,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
        ];
    }
}
