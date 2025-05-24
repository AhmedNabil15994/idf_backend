<?php

namespace Modules\Slider\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Projects\Transformers\Dashboard\ProjectResource;

class SliderResource extends Resource
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
            'image' => $this->getFirstMediaUrl('images'),
            'status' => $this->is_active,
            'type' => $this->type,
            'link' => $this->link,
            'project' => new ProjectResource($this->project),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'deleted_at' => $this->deleted_at,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
        ];
    }
}
