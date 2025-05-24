<?php

namespace Modules\Slider\Transformers\Frontend;

use Illuminate\Http\Resources\Json\Resource;

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
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type,
            'target' =>  $this->type == 'link' ? $this->link : url(route('frontend.projects.show',optional($this->project->translate(locale()))->slug)),
            'image' => $this->getFirstMediaUrl('images'),
        ];
    }
}
