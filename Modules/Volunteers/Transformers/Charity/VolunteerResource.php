<?php

namespace Modules\Volunteers\Transformers\Charity;

use Illuminate\Http\Resources\Json\Resource;

class VolunteerResource extends Resource
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
            'status' => $this->status,
            'image' => $this->getFirstMediaUrl('images') && $this->getFirstMediaUrl('images') != '' ? $this->getFirstMediaUrl('images') : asset('uploads/users/user.png'),
            'user_id' => optional($this->user)->name,
            'phone' => optional($this->user)->mobile,
            'email' => optional($this->user)->email,
            'charity' => $this->charity ? optional($this->charity->translateOrDefault(locale()))->title : '',
            'deleted_at' => $this->deleted_at,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
        ];
    }
}
