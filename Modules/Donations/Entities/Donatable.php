<?php

namespace Modules\Donations\Entities;

use Illuminate\Database\Eloquent\Model;

class Donatable extends Model 
{

    protected $table = 'donatables';
    public $timestamps = true;
    protected $fillable = array('donation_id', 'donatable_type', 'donatable_id', 'amount');

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }

}