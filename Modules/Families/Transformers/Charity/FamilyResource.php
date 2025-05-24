<?php

namespace Modules\Families\Transformers\Charity;

use Illuminate\Http\Resources\Json\Resource;

class FamilyResource extends Resource
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
            'head_name' => $this->head_info->name,
            'head_phone' => $this->head_info->phone,
            'head_current_salary' => $this->head_info->current_salary,
            'members_count' => $this->members_count,
            'charity' => $this->charity ? optional($this->charity->translateOrDefault(locale()))->title : '',
            'baskets' => pluckModelsCols($this->baskets()->get() , 'title','id',true),
            'deleted_at' => $this->deleted_at,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
        ];
    }
}
