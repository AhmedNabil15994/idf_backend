<?php

namespace Modules\Order\Transformers\Charity;

use Illuminate\Http\Resources\Json\Resource;

class OrderResource extends Resource
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
            'baskets_count' => $this->baskets()->count(),
            'status' => $this->status,
            'period' => $this->period ?? 0,
            'family_members_count' => optional($this->family->members())->count(),
            'family_leader_name' => optional($this->family->head_info)->name,
            'volunteer_name' => $this->volunteer ? optional($this->volunteer->user)->name : '',
            'deleted_at' => $this->deleted_at,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
        ];
    }
}
