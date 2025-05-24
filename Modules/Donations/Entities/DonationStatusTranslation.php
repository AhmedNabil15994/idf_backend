<?php

namespace Modules\Donations\Entities;

use Illuminate\Database\Eloquent\Model;

class DonationStatusTranslation extends Model
{

    protected $table = 'donation_status_translations';
    public $timestamps = true;
    protected $fillable = array('title', 'locale', 'donation_status_id');

}