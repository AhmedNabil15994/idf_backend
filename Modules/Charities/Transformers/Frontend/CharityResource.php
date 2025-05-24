<?php

namespace Modules\Charities\Transformers\Frontend;

use Illuminate\Http\Resources\Json\Resource;

class CharityResource extends Resource
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
            'title' => optional($this->translate(locale()))->title,
            'description' => optional($this->translate(locale()))->description,
            'logo' => $this->getFirstMediaUrl('images'),
            'phone' => $this->phone,
            'email' => optional($this->user)->email,
            'families_count' => $this->families()->count(),
        ];
    }
}
