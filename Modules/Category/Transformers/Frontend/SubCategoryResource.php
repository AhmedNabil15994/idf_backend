<?php

namespace Modules\Category\Transformers\Frontend;

use Illuminate\Http\Resources\Json\Resource;

class SubCategoryResource extends Resource
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
           'title'         => $this->translate(locale())->title,
           'image'         => $this->getFirstMediaUrl('images'),
       ];
    }
}
