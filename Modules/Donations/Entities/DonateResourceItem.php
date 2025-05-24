<?php

namespace Modules\Donations\Entities;

use Illuminate\Database\Eloquent\Model;

class DonateResourceItem extends Model 
{

    protected $table = 'donate_resource_items';
    public $timestamps = true;
    protected $fillable = array('categories', 'quantity', 'item_type_id', 'donate_resource_id');

    public function donate()
    {
        return $this->belongsTo(DonateResource::class);
    }

    public function type()
    {
        return $this->belongsTo(ItemType::class , 'item_type_id');
    }

}