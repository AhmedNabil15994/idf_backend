<?php

namespace Modules\Order\Transformers\Frontend;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Projects\Transformers\Frontend\ProjectResource;

class CartItemsResource extends Resource
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
            'project' => (new ProjectResource($this->id))->jsonSerialize(),
            'price' => $this->price * $this->qty
        ];
    }
}
