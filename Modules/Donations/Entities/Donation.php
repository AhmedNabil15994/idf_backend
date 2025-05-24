<?php

namespace Modules\Donations\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Baskets\Entities\FoodBasket;
use Modules\Projects\Entities\Project;

class Donation extends Model 
{
    protected $table = 'donations';
    public $timestamps = true;
    protected $fillable = array('donor_id', 'total','donor_type','name','email','mobile');

    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    public function paymentStatus()
    {
        return $this->belongsTo(DonationStatus::class,'donation_status_id');
    }

    public function projects()
    {
        return $this->morphedByMany(Project::class , 'donatable')->withPivot('amount');
    }

    public function foodBaskets()
    {
        return $this->morphedByMany(FoodBasket::class, 'donatable')->withPivot('amount');
    }

    public function items()
    {
        return $this->hasMany(Donatable::class);
    }

}