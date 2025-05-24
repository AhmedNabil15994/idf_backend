<?php

namespace Modules\Projects\Transformers\Frontend;

use Illuminate\Http\Resources\Json\Resource;

class ProjectResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
//        dd($this->resource);
        return [
            'id' => $this->id,
            'title' => $this->translate(locale())->title,
            'slug' => $this->translate(locale())->slug,
            'description' => $this->translate(locale())->description,
            'amount_to_collect' => $this->amount_to_collect,
            'total_donation' => $this->total_donation,
            'type' => $this->type,
            'link' => $this->link,
            'percent' => $this->total_donation > 0 ? ($this->total_donation/$this->amount_to_collect * 100) : 0,
//            'percent' => 0,
            'country' => optional($this->country->translate(locale()))->title,
            'image' => $this->getFirstMediaUrl('images'),
        ];
    }
}
