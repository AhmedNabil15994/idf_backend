<?php

namespace Modules\Donations\Transformers\Dashboard;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;
use Modules\Baskets\Transformers\Dashboard\BasketResource;
use Modules\Projects\Transformers\Dashboard\ProjectResource;

class DonationResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $record = [
            'id' => $this->id,
            'total' => $this->total,
            'name' => $this->donor_type == 'quick_donation'? $this->name : __('donations::dashboard.donations.datatable.helpful'),
            'email' => $this->donor_type == 'quick_donation'? $this->email : __('donations::dashboard.donations.datatable.helpful'),
            'mobile' => $this->donor_type == 'quick_donation'? $this->mobile : __('donations::dashboard.donations.datatable.helpful'),
            'status' => $this->status == 'paid' ?
                '<span class="badge badge-success">'.__('donations::dashboard.donations.datatable.payment_success').'</span>'
                : '<span class="badge badge-warning">'. __('donations::dashboard.donations.datatable.pending').'</span>',

            'donor_type' => $this->donor_type,
            'donor' => new DonorResource($this->donor),
            'deleted_at' => $this->deleted_at,
            'created_at' => Carbon::parse($this->created_at)->locale(locale())->isoFormat('dddd  , MMMM  ,  Do / YYYY '),
        ];

        $model = $this;
        $baskets = BasketResource::collection($this->foodBaskets);
        $projects = view('donations::dashboard.donations.components.projects',['projects' => ProjectResource::collection($this->projects),'model' => $model])->render();
        $record['projects'] = $projects;

        $record['modal'] = view('donations::dashboard.donations.show-modal', compact('record','projects','baskets','model'))->render();

        return $record;
    }
}
