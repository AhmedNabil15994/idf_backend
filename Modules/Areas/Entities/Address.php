<?php

namespace Modules\Areas\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Families\Entities\Family;

class Address extends Model 
{

    protected $table = 'address';
    public $timestamps = true;
    protected $fillable = array('city_id','region', 'family_id', 'street', 'building_number', 'floor_number', 'apartment','gada_number','ale_number');

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function getGovernorateAttribute()
    {
        return optional(optional($this->city)->governorate);
    }

}