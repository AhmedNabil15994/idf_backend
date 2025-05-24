<?php

namespace Modules\Slider\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Company\Transformers\Api\CompanyResource;

class SliderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image' => url($this->image),
            'type' => $this->type,
            'link' => $this->link,
            'company' => new CompanyResource($this->company),
        ];
    }
}
