<?php

namespace Modules\Order\Transformers\Dashboard;

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
            'status_view' => $this->status == 'pending' ? '<span class="badge badge-warning"> '.__('order::dashboard.orders.datatable.status_name.pending').' </span>'
                : '<span class="badge badge-success"> '.__('order::dashboard.orders.datatable.status_name.delivered').' </span>',
            'family_members_count' => optional($this->family->members())->count(),
            'family_leader_name' => optional($this->family->head_info)->name,
            'volunteer_id' => $this->volunteer ? optional($this->volunteer->user)->name : '',
            'deleted_at' => $this->deleted_at,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
        ];
    }
}
