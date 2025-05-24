<?php

namespace Modules\Projects\Transformers\Dashboard;

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
        return [
            'id' => $this->id,
            'title' => $this->translate(locale())->title,
            'status' => $this->status,
            'description' => $this->translate(locale())->description,
            'amount_to_collect' => $this->amount_to_collect,
            'total_donation' => $this->total_donation,
            'country_id' => optional($this->country->translate(locale()))->title,
            'categories' => $this->categories()->count() ?
                pluckModelsCols($this->categories()->get(),'title','id',true) : null,
            'image' => $this->getFirstMediaUrl('images'),
            'deleted_at' => $this->deleted_at,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
        ];
    }
}
