<?php

namespace Modules\Page\Transformers\Frontend;

use Illuminate\Http\Resources\Json\Resource;

class PageResource extends Resource
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
            'description' => $this->translate(locale())->description,
            'long_description' => $this->translate(locale())->long_description,
            'slug' => $this->translate(locale())->slug,
        ];
    }
}
