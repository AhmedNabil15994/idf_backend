<?php

namespace Modules\Families\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Charities\Entities\Charity;

class CharityFamily extends Model 
{

    protected $table = 'charity_family';
    public $timestamps = true;
    protected $fillable = array('family_id', 'charity_id','support_type');

    public function family() {
        return $this->belongsTo(Family::class);
    }

    public function charity() {
        return $this->belongsTo(Charity::class);
    }
}